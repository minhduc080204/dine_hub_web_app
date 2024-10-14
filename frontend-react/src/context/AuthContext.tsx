import React, { createContext, useContext, useState, useEffect } from 'react';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { setUser } from '../store/slices/userSlice';
import axiosInstance from '../config/axios/config';
import { ENDPOINTS } from '../config';
import { showMessage } from '../utils';
import { useDispatch } from 'react-redux';
import { GoogleSignin } from '@react-native-google-signin/google-signin';
import { TokenResponse, useGoogleLogin } from '@react-oauth/google';

GoogleSignin.configure({
  webClientId: "848690270588-8ldfjqsueids25j0eekmfmiin2msumje.apps.googleusercontent.com",
})

export const AuthContext = createContext<any>(null);
export const AuthProvider = ({ children }: any) => {
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [userToken, setUserToken] = useState<string | null>(null);
  const [userInfor, setUserInfor] = useState<string | null>(null);
  const dispatch = useDispatch();

  const loginGoogleWeb = useGoogleLogin({
    onSuccess: async (tokenResponse: TokenResponse) => {
      const accessToken = tokenResponse.access_token; // Lấy access_token

      if (accessToken) {
        try {
          // Gửi yêu cầu đến Google UserInfo API để lấy thông tin người dùng
          const userInfoResponse = await fetch('https://www.googleapis.com/oauth2/v3/userinfo', {
            headers: {
              Authorization: `Bearer ${accessToken}`,
            },
          });

          if (!userInfoResponse.ok) {
            throw new Error('Failed to fetch user info');
          }

          const userProfile = await userInfoResponse.json();

          const email = userProfile.email;
          const user_name = userProfile.name;
          const password = "alksnvksvnkdjsnv;ksndvknknajshkca";

          try {
            setIsLoading(true);
            const res = await axiosInstance.post(ENDPOINTS.auth.check, { email });

            if (res.data.id) {
              register(user_name, email, password, password);
            } else {

              const token = res.data.access_token;
              const user = res.data.user;
              setUserToken(token);
              setUserInfor(user);
              await AsyncStorage.setItem('userInfor', JSON.stringify(user));
              await AsyncStorage.setItem('userToken', token);
              dispatch(setUser(user));
            }
          } finally {
            setIsLoading(false);
          }

        } catch (error) {
          console.error('Error fetching user profile:', error);
        }
      }
    }
  });

  const login = async (email: string, password: string) => {
    try {
      setIsLoading(true);

      const res = await axiosInstance.post(ENDPOINTS.auth.login, { email, password });
      const token = res.data.access_token;
      const user = res.data.user;

      setUserToken(token);
      setUserInfor(user);
      await AsyncStorage.setItem('userInfor', JSON.stringify(user));
      await AsyncStorage.setItem('userToken', token);

      dispatch(setUser(user));
    } catch (error: any) {
      let codeErr = error.status;
      if (codeErr == 401) {
        return showMessage({
          message: 'Login Failed :(',
          description: `Wrong email or password. Try again!`,
          type: 'danger',
          icon: 'danger',
        })
      }

      return showMessage({
        message: 'Login Failed :(',
        description: `Lỗi ko xác định!`,
        type: 'danger',
        icon: 'danger',
      });
    } finally {
      setIsLoading(false);
    }
  };

  const register = async (name: string, email: string, password: string, password_c: string) => {
    if (password !== password_c) {
      showMessage({
        message: 'Retype password ',
        description: `Password does not match!`,
        type: 'warning',
        icon: 'warning',
      });
      return;
    }

    const data = {
      user_name: name,
      email: email,
      password: password,
      password_confirmation: password_c,
    };

    try {
      setIsLoading(true);
      const res = await axiosInstance.post(ENDPOINTS.auth.register, data);
      const token = res.data.access_token;
      const user = res.data.user;
      
      setUserToken(token);
      setUserInfor(user);
      await AsyncStorage.setItem('userInfor', JSON.stringify(user));
      await AsyncStorage.setItem('userToken', token);
      dispatch(setUser(user));

    } catch (error: any) {
      let codeErr = error.status;
      if (codeErr == 422) {
        return showMessage({
          message: 'Use other Email',
          description: `Email has been registered!`,
          type: 'danger',
          icon: 'danger',
        });
      }

      if (error.response) {
        console.log(`Registration failed: ${error.response.data.message}`);
      } else {
        console.log(`Registration error: ${error.message}`);
      }
    } finally {
      setIsLoading(false);
      
    }
  };



  const logout = async () => {
    setIsLoading(true);
    try {
      // Xóa thông tin trong AsyncStorage
      await AsyncStorage.removeItem('userInfor');
      await AsyncStorage.removeItem('userToken');

      // Reset thông tin người dùng trong Redux
      dispatch(setUser(null));

      // Reset trạng thái context
      setUserToken(null);
      setUserInfor(null);

      showMessage({
        message: 'Logged out successfully',
        type: 'success',
        icon: 'success',
      });
    } catch (error) {
      console.error('Logout error: ', error);
    } finally {
      setIsLoading(false);
    }
  };

  const isLoggedIn = async () => {
    try {
      setIsLoading(true);
      let userToken = await AsyncStorage.getItem('userToken');
      let userInfor = await AsyncStorage.getItem('userInfor');
      if (userInfor) {
        userInfor = JSON.parse(userInfor);
        setUserToken(userToken);
        setUserInfor(userInfor);
      }
      setIsLoading(false);
    } catch (e) {
      console.log(`Login error: ${e}`);
    }
  };

  useEffect(() => {
    isLoggedIn();
  }, []);

  return (
    <AuthContext.Provider value={{ loginGoogleWeb, login, logout, register, isLoading, userToken, userInfor }}>
      {children}
    </AuthContext.Provider>
  );
};
