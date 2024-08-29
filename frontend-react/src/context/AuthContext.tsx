import React, {createContext, useContext, useState, useEffect} from 'react';
import AsyncStorage from '@react-native-async-storage/async-storage';
import {setUser} from '../store/slices/userSlice';
import axiosInstance from '../config/axios/config';
export const AuthContext = createContext<any>(null);

export const AuthProvider = ({children}: any) => {
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [userToken, setUserToken] = useState<string | null>(null);
  const [userInfor, setUserInfor] = useState<string | null>(null);

  const login = async (email: string, password: string) => {
    setIsLoading(true);
    const res = await axiosInstance.post('/auth/login', {
      email,
      password,
    });
    const token = res.data.access_token;
    const user = res.data.user;
    setUserToken(token);
    AsyncStorage.setItem('userInfor', JSON.stringify(user));
    AsyncStorage.setItem('userToken', token);
    setIsLoading(false);
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
      userInfor = JSON.parse(userInfor);
      if (userInfor) {
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
    <AuthContext.Provider value={{login, logout, isLoading, userToken, userInfor}}>
      {children}
    </AuthContext.Provider>
  );
};
