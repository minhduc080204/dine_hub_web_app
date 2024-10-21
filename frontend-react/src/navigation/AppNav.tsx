import React, { useState, useContext } from "react";
import StackNavigator from './StackNavigator';
import AuthStackNavigator from './AuthStackNavigator';
import Loader from '../components/Loader';
import {NavigationContainer} from '@react-navigation/native';
import {AuthContext} from '../context/AuthContext';
import SignIn from "../screens/auth/SignIn";
import Home from "../screens/tabs/Home";
import { Text } from "react-native-svg";

function AppNav() {
    const {isLoading, userToken} = useContext(AuthContext);
    
    if(isLoading) {
       return ( <Loader /> );
    }
    return (
        <NavigationContainer>
            {/* {userToken != null ? <StackNavigator /> : <AuthStackNavigator />}             */}
            <StackNavigator />

        </NavigationContainer>
        // <SignIn></SignIn>
        // <Home></Home>
        // <Text>Hello</Text>
    );
}

export default AppNav;
