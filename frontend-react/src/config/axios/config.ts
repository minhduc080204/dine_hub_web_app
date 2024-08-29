import AsyncStorage from '@react-native-async-storage/async-storage';
import axios from 'axios';

const axiosInstance = axios.create({
  baseURL: 'http://127.0.0.1:8000/api',
  timeout: 1000,
  headers: {
    'Content-Type': 'application/json',
  },
});


axiosInstance.interceptors.request.use(
  config => {
    const token = AsyncStorage.getItem('userToken'); 
    if (token) {
      config.headers['Authorization'] = `Bearer ${token}`;
    }
    return config;
  },
  error => {
    return Promise.reject(error);
  }
);

// Thêm một interceptor cho response
axiosInstance.interceptors.response.use(
  response => {
    // Xử lý response trước khi trả về dữ liệu
    return response;
  },
  error => {
    // Xử lý lỗi response, ví dụ xử lý lỗi 401
    if (error.response && error.response.status === 401) {
      // Xử lý logout, clear token, chuyển hướng sang tr
    }
    return Promise.reject(error);
  }
);

export default axiosInstance;
