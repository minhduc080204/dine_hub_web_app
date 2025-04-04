import axios from 'axios';
import {View, TextInput, TouchableOpacity} from 'react-native';
import React, {useState, useEffect, useRef, useContext} from 'react';

import {svg} from '../assets/svg';
import {theme} from '../constants';
import {showMessage} from '../utils';
import {components} from '../components';
import {useAppNavigation} from '../hooks';
import {validation} from '../utils/validation';
import {setUser} from '../store/slices/userSlice';
import {BASE_URL, ENDPOINTS, CONFIG} from '../config';
import {useAppSelector, useAppDispatch} from '../hooks';
import { AuthContext } from '../context/AuthContext';
import { t } from 'i18next';

const EditProfile: React.FC = (): JSX.Element => {
  const { userInfor} = useContext(AuthContext);
  const navigation = useAppNavigation();
  const user = useAppSelector((state) => state.userSlice.user);
  
  const dispatch = useAppDispatch();

  const [loading, setLoading] = useState<boolean>(false);

  const [email, setEmail] = useState<string>(userInfor.email);
  const [address, setAdress] = useState<string>('');
  const [userName, setUserName] = useState<string>(userInfor.user_name);
  const [phoneNumber, setPhoneNumber] = useState<string>('');

  const data = {email, userName, address};

  const inp1Ref = useRef<TextInput>({focus: () => {}} as TextInput);
  const inp2Ref = useRef<TextInput>({focus: () => {}} as TextInput);
  const inp3Ref = useRef<TextInput>({focus: () => {}} as TextInput);
  const inp4Ref = useRef<TextInput>({focus: () => {}} as TextInput);

  useEffect(() => {
    if (loading) {
      inp1Ref.current.blur();
      inp2Ref.current.blur();
      inp3Ref.current.blur();
    }
  }, [loading]);

  const renderStatusBar = () => {
    return <components.StatusBar />;
  };

  const renderHeader = () => {
    return <components.Header goBack={true} title={t('personal_info')} />;
  };

  const renderUserImage = () => {
    return (
      <TouchableOpacity
        style={{
          width: 100,
          height: 100,
          alignSelf: 'center',
          marginBottom: 30,
          justifyContent: 'center',
          alignItems: 'center',
        }}
      >
        <components.Image
          source={{
            uri: 'https://george-fx.github.io/dine-hub/10.jpg',
          }}
          style={{
            position: 'absolute',
            width: '100%',
            height: '100%',
            borderRadius: 50,
          }}
        />
        <View
          style={{
            backgroundColor: theme.colors.mainColor,
            position: 'absolute',
            bottom: 0,
            right: 0,
            left: 0,
            top: 0,
            borderRadius: 50,
            opacity: 0.3,
          }}
        />
        <svg.CameraSvg />
      </TouchableOpacity>
    );
  };

  const renderInputFields = () => {
    return (
      <React.Fragment>
        <components.InputField
          value={userName}
          innerRef={inp1Ref}
          placeholder={t('name')}
          onChangeText={(text) => setUserName(text)}
          type='username'
          containerStyle={{marginBottom: 14}}
        />
        <components.InputField
          value={email}
          innerRef={inp2Ref}
          placeholder={t('email')}
          onChangeText={(text) => setEmail(text)}
          type='email'
          // checkIcon={true}
          containerStyle={{marginBottom: 14}}
        />
        <components.InputField
          value={phoneNumber}
          innerRef={inp3Ref}
          placeholder={t('phone')}
          onChangeText={(text) => setPhoneNumber(text)}
          type='phone'
          containerStyle={{marginBottom: 14}}
        />
        <components.InputField
          value={address}
          innerRef={inp4Ref}
          placeholder={t('address')}
          onChangeText={(text) => setAdress(text)}
          type='location'
          containerStyle={{marginBottom: 20}}
        />
      </React.Fragment>
    );
  };

  const renderButton = () => {
    return (
      <View>
        <components.Button
          title={t('save_changes')}
          loading={loading}
          onPress={() => {
            setLoading(true)
            if(validation({email, userName, phoneNumber, address})){
              navigation.goBack();
              showMessage({
                message: 'New infor new 4`',
                description: `Edit profile success`,
                type: 'success',
                icon: 'success',
              })
              
            }
            setLoading(false)
          }}
          containerStyle={{marginBottom: 14}}
        />
      </View>
    );
  };

  const renderContent = () => {
    const contentContainerStyle = {
      backgroundColor: theme.colors.white,
      marginHorizontal: 20,
      paddingBottom: 30,
      paddingTop: 50,
      paddingHorizontal: 20,
      borderRadius: 10,
      marginTop: 10,
      flexGrow: 0,
    };

    return (
      <components.KAScrollView
        contentContainerStyle={{...contentContainerStyle}}
      >
        {renderUserImage()}
        {renderInputFields()}
        {renderButton()}
      </components.KAScrollView>
    );
  };

  const renderHomeIndicator = () => {
    return <components.HomeIndicator />;
  };

  return (
    <components.SmartView>
      {renderStatusBar()}
      {renderHeader()}
      {renderContent()}
      {renderHomeIndicator()}
    </components.SmartView>
  );
};

export default EditProfile;
