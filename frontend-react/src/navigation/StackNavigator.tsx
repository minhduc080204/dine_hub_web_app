import React, { useContext, useEffect } from 'react';

import pusherJs from 'pusher-js';
import { showMessage } from 'react-native-flash-message';
import MessageSvg from '../assets/svg/MessageSvg';
import { theme } from '../constants';
import { AuthContext } from '../context/AuthContext';
import { Stack, useAppNavigation } from '../hooks';
import { screens } from '../screens';
import Chat from '../screens/tabs/Chat';
import TabNavigator from './TabNavigator';

const StackNavigator: React.FC = () => {
  const { userInfor } = useContext(AuthContext);

  const navigation = useAppNavigation();
  useEffect(() => {
    const pusher = new pusherJs('905ea1087d251dc4a082', {
      cluster: 'ap1',
    });

    const channel = pusher.subscribe('commonroom');
    channel.bind('CommonChannel', (data: any) => {
      if (data && data.message) {
        if (userInfor.id == data.userId && data.role == 'admin') {
          showMessage({
            message: 'You have message from Admin',
            description: `Admin: ${data.message}`,
            // type: 'success',
            // icon: 'success',
            backgroundColor: theme.colors.mainTurquoise,
            duration: 3500,
            icon: MessageSvg,
            onPress() {
              navigation.navigate('Chat')
            },
          });
        }
      }
    });

    return () => {
      channel.unbind_all();
      channel.unsubscribe();
    };
  }, []);
  return (
    <Stack.Navigator>
      {/* <Stack.Screen
        name='Onboarding'
        component={screens.Onboarding}
        options={{headerShown: false}}
        /> */}
      <Stack.Screen
        name='TabNavigator'
        component={TabNavigator}
        options={{ headerShown: false, title: 'Your Name Coffee' }}
      />
      <Stack.Screen
        name='Chat'
        component={Chat}
        options={{ headerShown: false }}
      />
      <Stack.Screen
        name='Home'
        component={screens.Home}
        options={{ headerShown: false }}
      />

      <Stack.Screen
        name='Product'
        component={screens.Product}
        options={{ headerShown: false }}
      />
      <Stack.Screen
        name='Reviews'
        component={screens.Reviews}
        options={{ headerShown: false }}
      />
      <Stack.Screen
        name='LeaveAReview'
        component={screens.LeaveAReview}
        options={{ headerShown: false }}
      />
      <Stack.Screen
        name='OrderHistory'
        component={screens.OrderHistory}
        options={{ headerShown: false }}
      />
      <Stack.Screen
        name='NewPassword'
        component={screens.NewPassword}
        options={{ headerShown: false }}
      />
      <Stack.Screen
        name='EditProfile'
        component={screens.EditProfile}
        options={{ headerShown: false }}
      />

      <Stack.Screen
        name='Checkout'
        component={screens.Checkout}
        options={{ headerShown: false }}
      />
      <Stack.Screen
        name='CheckoutPay'
        component={screens.CheckoutPay}
        options={{ headerShown: false }}
      />
      <Stack.Screen
        name='OrderSuccessful'
        component={screens.OrderSuccessful}
        options={{ headerShown: false }}
      />
      <Stack.Screen
        name='OrderFailed'
        component={screens.OrderFailed}
        options={{ headerShown: false }}
      />
      <Stack.Screen
        name='Menulist'
        component={screens.Menulist}
        options={{ headerShown: false }}
      />
      <Stack.Screen
        name='VerifyYourPhoneNumber'
        component={screens.VerifyYourPhoneNumber}
        options={{ headerShown: false }}
      />
      <Stack.Screen
        name='TrackYourOrder'
        component={screens.TrackYourOrder}
        options={{ headerShown: false }}
      />
      <Stack.Screen
        name='Promocodes'
        component={screens.Promocodes}
        options={{ headerShown: false }}
      />
      <Stack.Screen
        name='Wallet'
        component={screens.Wallet}
        options={{ headerShown: false }}
      />
      <Stack.Screen
        name='AddANewCard'
        component={screens.AddANewCard}
        options={{ headerShown: false }}
      />

      



      <Stack.Screen
        name='SignIn'
        component={screens.SignIn}
        options={{ headerShown: false }}
      />
      <Stack.Screen
        name='SignUp'
        component={screens.SignUp}
        options={{headerShown: false}}
      /> 
      <Stack.Screen
        name='ConfirmationCode'
        component={screens.ConfirmationCode}
        options={{headerShown: false}}
      />
      <Stack.Screen
        name='SignUpaccountCreated'
        component={screens.SignUpaccountCreated}
        options={{headerShown: false}}
      />
      <Stack.Screen
        name='ForgotPassword'
        component={screens.ForgotPassword}
        options={{headerShown: false}}
      />
      <Stack.Screen
        name='ForgotPasswordSentEmail'
        component={screens.ForgotPasswordSentEmail}
        options={{headerShown: false}}
      />      
    </Stack.Navigator>
  );
};

export default StackNavigator;
