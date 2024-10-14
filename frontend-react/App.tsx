import { useFonts } from 'expo-font';
import { Provider } from 'react-redux';
import React, { useCallback, useContext } from 'react';
import { components } from './src/components';
import * as SplashScreen from 'expo-splash-screen';
import { persistor, store } from './src/store/store';
import FlashMessage from 'react-native-flash-message';
import { PersistGate } from 'redux-persist/integration/react';
import StackNavigator from './src/navigation/StackNavigator';
import { NavigationContainer } from '@react-navigation/native';
import { SafeAreaProvider } from 'react-native-safe-area-context';
import { AuthProvider } from './src/context/AuthContext';
import AppNav from './src/navigation/AppNav';
import { GoogleOAuthProvider } from '@react-oauth/google';


export default function App() {
  const [fontsLoaded] = useFonts({
    'DMSans-Bold': require('./src/assets/fonts/DMSans-Bold.ttf'),
    'DMSans-Medium': require('./src/assets/fonts/DMSans-Medium.ttf'),
    'DMSans-Regular': require('./src/assets/fonts/DMSans-Regular.ttf'),
  });

  const onLayoutRootView = useCallback(async () => {
    if (fontsLoaded) {
      await SplashScreen.hideAsync();
    }
  }, [fontsLoaded]);

  if (!fontsLoaded) {
    return null;
  }

  return (
    <SafeAreaProvider onLayout={onLayoutRootView}>
      <GoogleOAuthProvider clientId="529775059239-o4e6r433b2l2uun0rj370arli9bgq516.apps.googleusercontent.com">
        <Provider store={store}>
          <PersistGate loading={<components.Loader />} persistor={persistor}>
            <AuthProvider>
              <AppNav />
            </AuthProvider>
          </PersistGate>
        </Provider>
        <FlashMessage position='top' floating={true} />
      </GoogleOAuthProvider>;
    </SafeAreaProvider>
  );
}
