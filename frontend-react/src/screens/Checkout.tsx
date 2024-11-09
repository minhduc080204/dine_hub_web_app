import type { NativeStackScreenProps } from '@react-navigation/native-stack';
import React, { useState } from 'react';
import { Text, TouchableOpacity, View } from 'react-native';

import { showMessage } from 'react-native-flash-message';
import { svg } from '../assets/svg';
import { components } from '../components';
import { theme } from '../constants';
import { useAppNavigation, useAppSelector } from '../hooks';
import { text } from '../text';
import type { RootStackParamList } from '../types';
import { t } from 'i18next';

type Props = NativeStackScreenProps<RootStackParamList, 'Checkout'>;

const Checkout: React.FC<Props> = ({route}): JSX.Element => {
  const {total, subtotal, delivery, discount} = route.params;
  const navigation = useAppNavigation();
  const [loading, setLoading] = useState(false);
  const cart = useAppSelector((state) => state.cartSlice.list);
  const [address, setAdress] = useState('');
  const [note, setNote] = useState('');

  const handleConfirmOrder = async () => {
    if (address === '') {
      return showMessage({
        message: 'Order Failed :(',
        description: `Please enter ADDRESS!`,
        type: 'warning',
        icon: 'warning',
      });
    }    
    navigation.navigate('CheckoutPay', {
      total,
      subtotal,
      discount,
      delivery,
      address,
      note,
    });
  };

  const renderStatusBar = () => {
    return <components.StatusBar />;
  };

  const renderHeader = () => {
    return <components.Header goBack={true} title={t('checkout')} />;
  };

  const renderOrderSummary = () => {
    return (
      <View
        style={{
          padding: 20,
          borderWidth: 1,
          borderRadius: 10,
          borderColor: theme.colors.mainTurquoise,
          marginBottom: 30,
        }}
      >
        <View
          style={{
            flexDirection: 'row',
            alignItems: 'center',
            justifyContent: 'space-between',
            borderBottomWidth: 1,
            borderBottomColor: '#DBE9F5',
            paddingBottom: 20,
            marginBottom: 20,
          }}
        >
          <text.H4>{t('total')}</text.H4>
          <text.H4>${total}</text.H4>
        </View>
        {cart.map((item, index) => {
          return (
            <View
              key={index}
              style={{
                flexDirection: 'row',
                alignItems: 'center',
                justifyContent: 'space-between',
                marginBottom: 10,
              }}
            >
              <text.T14>{item.name}</text.T14>
              <text.T14>
                {item.quantity} x ${item.price}
              </text.T14>
            </View>
          );
        })}
        {discount > 0 && (
          <View
            style={{
              flexDirection: 'row',
              alignItems: 'center',
              justifyContent: 'space-between',
              marginBottom: 10,
            }}
          >
            <text.T14>Discount</text.T14>
            <text.T14>- ${discount.toFixed(2)}</text.T14>
          </View>
        )}
        <View
          style={{
            flexDirection: 'row',
            alignItems: 'center',
            justifyContent: 'space-between',
          }}
        >
          <text.T14>{t('delivery')}</text.T14>
          <text.T14>${delivery}</text.T14>
        </View>
      </View>
    );
  };

  const renderShippingDetails = () => {
    return (
      <TouchableOpacity
        style={{
          padding: 20,
          backgroundColor: theme.colors.white,
          borderRadius: 10,
          marginBottom: 14,
          flexDirection: 'row',
          alignItems: 'center',
          justifyContent: 'space-between',
        }}
        onPress={() => {}}
      >
        <View>
          <Text
            style={{
              ...theme.fonts.DMSans_500Medium,
              fontSize: 14,
              textTransform: 'capitalize',
              color: theme.colors.mainColor,
              marginBottom: 10,
            }}
          >
            Shipping details
          </Text>
          <Text
            style={{
              ...theme.fonts.DMSans_400Regular,
              color: theme.colors.textColor,
              fontSize: 12,
              lineHeight: 12 * 1.5,
            }}
          >
            8000 S Kirkland Ave, Chicago, IL 6065...
          </Text>
        </View>
        <svg.ArrowRightSvg />
      </TouchableOpacity>
    );
  };

  const renderAddressField = () => {
    return (
      <View
        style={{
          backgroundColor: theme.colors.white,
          paddingHorizontal: 20,
          paddingVertical: 20,
          borderRadius: 10,
        }}
      >
        <components.InputField
          type='address'
          placeholder={t('address')}
          value={address}
          onChangeText={(text) => {
            setAdress(text);
          }}
        />
      </View>
    );
  };

  const renderNoteField = () => {
    return (
      <View
        style={{
          backgroundColor: theme.colors.white,
          paddingHorizontal: 20,
          paddingVertical: 20,
          borderRadius: 10,
        }}
      >
        <components.InputFieldBig
          containerStyle={{marginBottom: 14}}
          value={note}
          placeholder={t('note')}
          onChangeText={(text) => {
            setNote(text);
          }}
        />
        <components.Button
          loading={loading}
          title={t('confirm_order')}
          onPress={() => {
            handleConfirmOrder()
          }}
        />
      </View>
    );
  };

  const renderContent = () => {
    const contentContainerStyle = {
      flexGrow: 1,
      paddingTop: 10,
      paddingBottom: 20,
      paddingHorizontal: 20,
    };

    return (
      <components.KAScrollView
        contentContainerStyle={{...contentContainerStyle}}
      >
        {renderOrderSummary()}
        {/* {renderShippingDetails()}
        {renderPaymentMethod()} */}
        {renderAddressField()}
        {renderNoteField()}
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

export default Checkout;
