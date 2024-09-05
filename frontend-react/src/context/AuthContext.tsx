import React, { createContext, useContext, useState, useEffect } from 'react';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { setUser } from '../store/slices/userSlice';
import axiosInstance from '../config/axios/config';
import { ENDPOINTS } from '../config';
import { showMessage } from '../utils';
import axios from 'axios';
import { useDispatch } from 'react-redux';
export const AuthContext = createContext<any>(null);

export const AuthProvider = ({ children }: any) => {
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [userToken, setUserToken] = useState<string | null>(null);
  const [userInfor, setUserInfor] = useState<string | null>(null);
  const dispatch = useDispatch(); 

  const login = async (email: string, password: string) => {
    try {
      setIsLoading(true);

      const res = await axiosInstance.post(ENDPOINTS.auth.login, { email, password });
      const token = res.data.access_token;
      const user = res.data.user;

      setUserToken(token);
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
      await AsyncStorage.setItem('userInfor', JSON.stringify(user));
      await AsyncStorage.setItem('userToken', token);

    } catch (error: any) {
      console.log(error);
      let codeErr = error.status;
      if(codeErr==422){
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



  const logout = () => {
    setIsLoading(true);
    setUserToken(null);
    AsyncStorage.removeItem('userInfor');
    AsyncStorage.removeItem('userToken');
    setIsLoading(false);
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
    <AuthContext.Provider value={{ login, logout, register, isLoading, userToken, userInfor }}>
      {children}
    </AuthContext.Provider>
  );
};
