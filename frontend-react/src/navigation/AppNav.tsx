import React, { useState, useContext } from "react";
import StackNavigator from './StackNavigator';
import AuthStackNavigator from './AuthStackNavigator';
import Loader from '../components/Loader';
import {NavigationContainer} from '@react-navigation/native';
import {AuthContext} from '../context/AuthContext';

function AppNav() {
    const {isLoading, userToken} = useContext(AuthContext);
    
    if(isLoading) {
       return ( <Loader /> );
    }
    return (
        <NavigationContainer>
            {userToken != null ? <StackNavigator /> : <AuthStackNavigator />}
        </NavigationContainer>
    );
}

export default AppNav;
