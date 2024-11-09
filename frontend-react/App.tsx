import { useFonts } from 'expo-font';
import * as SplashScreen from 'expo-splash-screen';
import React, { useCallback } from 'react';
import FlashMessage from 'react-native-flash-message';
import { SafeAreaProvider } from 'react-native-safe-area-context';
import { Provider } from 'react-redux';
import { PersistGate } from 'redux-persist/integration/react';
import { components } from './src/components';
import { AuthProvider } from './src/context/AuthContext';
import AppNav from './src/navigation/AppNav';
import { persistor, store } from './src/store/store';
import { I18nextProvider } from 'react-i18next';
import i18n from './i18n';


export default function App() {
  const [fontsLoaded] = useFonts({
    'DMSans-Bold': require('./src/assets/fonts/OpenSans-Bold.ttf'),
    'DMSans-Medium': require('./src/assets/fonts/OpenSans-Medium.ttf'),
    'DMSans-Regular': require('./src/assets/fonts/OpenSans-Regular.ttf'),
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
      <Provider store={store}>
        <PersistGate loading={<components.Loader />} persistor={persistor}>
          <AuthProvider>
            <I18nextProvider i18n={i18n}>
            <AppNav />
              {/* <App /> */}
            </I18nextProvider>
          </AuthProvider>
        </PersistGate>
      </Provider>
      <FlashMessage position='top' floating={true} />
    </SafeAreaProvider>
  );
}

// import { useEffect, useState } from "react";
// import { StyleSheet, Text, View, Button, Image } from "react-native";
// import * as WebBrowser from "expo-web-browser";
// import * as Google from "expo-auth-session/providers/google";
// import AsyncStorage from "@react-native-async-storage/async-storage";

// WebBrowser.maybeCompleteAuthSession();

// export default function App() {
//   const [token, setToken] = useState("");
//   const [userInfo, setUserInfo] = useState(null);

//   const [request, response, promptAsync] = Google.useAuthRequest({
//     webClientId: "529775059239-o4e6r433b2l2uun0rj370arli9bgq516.apps.googleusercontent.com",
//     androidClientId: "529775059239-7u57lvor7ovm67cp9c9buqqi6j7qarac.apps.googleusercontent.com",
//     iosClientId: "529775059239-2l5jv9hmb3cvfaff3rdpllbj18p5vmki.apps.googleusercontent.com",
//   });

//   useEffect(() => {
//     handleEffect();
//   }, [response, token]);

//   async function handleEffect() {
//     const user = await getLocalUser();
//     console.log("user", user);
//     if (!user) {
//       if (response?.type === "success") {
//         // setToken(response.authentication.accessToken);
//         getUserInfo(response.authentication?.accessToken);
//       }
//     } else {
//       setUserInfo(user);
//       console.log("loaded locally");
//     }
//   }

//   const getLocalUser = async () => {
//     const data = await AsyncStorage.getItem("@user");
//     if (!data) return null;
//     return JSON.parse(data);
//   };

//   const getUserInfo = async (token:any) => {
//     if (!token) return;
//     try {
//       const response = await fetch(
//         "https://www.googleapis.com/userinfo/v2/me",
//         {
//           headers: { Authorization: `Bearer ${token}` },
//         }
//       );

//       const user = await response.json();
//       await AsyncStorage.setItem("@user", JSON.stringify(user));
//       setUserInfo(user);
//     } catch (error) {
//       // Add your own error handler here
//     }
//   };

//   return (
//     <View style={styles.container}>
//       {!userInfo ? (
//         <Button
//           title="Sign in with Google"
//           disabled={!request}
//           onPress={() => {
//             promptAsync();
//           }}
//         />
//       ) : (
//         <View style={styles.card}>
//           {userInfo?.picture&& (
//             <Image source={{ uri: userInfo?.picture }} style={styles.image} />
//           )}
//           <Text style={styles.text}>Email: {userInfo.email}</Text>
//           <Text style={styles.text}>
//             Verified: {userInfo.verified_email ? "yes" : "no"}
//           </Text>
//           <Text style={styles.text}>Name: {userInfo.name}</Text>
//           {/* <Text style={styles.text}>{JSON.stringify(userInfo, null, 2)}</Text> */}
//         </View>
//       )}
//       <Button
//         title="remove local store"
//         onPress={async () => await AsyncStorage.removeItem("@user")}
//       />
//     </View>
//   );
// }

// const styles = StyleSheet.create({
//   container: {
//     flex: 1,
//     backgroundColor: "#fff",
//     alignItems: "center",
//     justifyContent: "center",
//   },
//   text: {
//     fontSize: 20,
//     fontWeight: "bold",
//   },
//   card: {
//     borderWidth: 1,
//     borderRadius: 15,
//     padding: 15,
//   },
//   image: {
//     width: 100,
//     height: 100,
//     borderRadius: 50,
//   },
// });