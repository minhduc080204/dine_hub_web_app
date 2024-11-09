import React, { useContext } from 'react';
import { ScrollView, View } from 'react-native';

import { NativeStackScreenProps } from '@react-navigation/native-stack';
import { components } from '../components';
import { theme } from '../constants';
import { AuthContext } from '../context/AuthContext';
import { useAppNavigation } from '../hooks';
import { useGetOrdersQuery } from '../store/slices/apiSlice';
import { text } from '../text';
import { RootStackParamList } from '../types';
import { t } from 'i18next';

type Props = NativeStackScreenProps<RootStackParamList, 'TrackYourOrder'>;

const TrackYourOrder: React.FC<Props> = ({ route }): JSX.Element => {
  const { userInfor } = useContext(AuthContext)
  const { data: orders, error, isLoading } = useGetOrdersQuery(userInfor.id);
  const { orderId } = route.params;
  const order = orders?.find((o: any) => o.id === orderId)

  const date = order?.created_at;
  const address = order?.address;
  const status = order?.order_status;
  const navigation = useAppNavigation();

  const renderStatusBar = () => {
    return <components.StatusBar />;
  };

  const renderHeader = () => {
    return <components.Header goBack={true} title={t('order_detail')} />;
  };

  const renderDescription = () => {
    return (
      <View
        style={{
          borderWidth: 1,
          borderColor: theme.colors.mainTurquoise,
          borderRadius: 10,
          marginHorizontal: 20,
          padding: 20,
          marginBottom: 10,
        }}
      >
        <View
          style={{ flexDirection: 'row', alignItems: 'center', marginBottom: 14 }}
        >
          <text.T14 style={{ marginRight: 14, textTransform: 'none' }}>
          {t('date')}
          </text.T14>
          <text.H5 style={{ color: theme.colors.mainTurquoise }}>{date}</text.H5>
        </View>
        <View style={{ flexDirection: 'row', alignItems: 'center' }}>
          <text.T14 style={{ marginRight: 14, textTransform: 'none' }}>
          {t('address_title')}
          </text.T14>
          <text.H5 style={{ color: theme.colors.mainTurquoise }}>
            {address}
          </text.H5>
        </View>
      </View>
    );
  };

  const renderOrderStatus = () => {
    const order_status = [
      {
        id: "Delivered",
        title: t('done'),
        description: t('completed_at')+'9:32 pm',
      },
      {
        id: "Shipping",
        title: t('shipping'),
        description: t('completed_at')+'9:32 pm',
      },
      {
        id: "Confirm",
        title: t('order_confirmed'),
        description: t('completed_at')+'9:32 pm',
      },
      {
        id: "Processing",
        title: t('processing'),
        description: t('completed_at')+'9:32 pm',
      },
    ]
    let checkStatus = false;
    return (
      <View
        style={{
          backgroundColor: theme.colors.white,
          marginHorizontal: 20,
          borderRadius: 10,
          padding: 30,
        }}
      >
        {order_status.map((os) => {
          status == os.id ? checkStatus = true : ""
          return (
            <components.OrderStatus
              key={os.id}
              title={os.title}
              description={checkStatus ? os.description : t('waiting')}
              status={checkStatus}
              containerStyle={{ marginBottom: 7 }}
            />
          )
        })}
      </View>
    );
  };

  const renderContent = () => {
    return (
      <ScrollView
        contentContainerStyle={{ flexGrow: 1, paddingTop: 10 }}
        showsVerticalScrollIndicator={false}
      >
        {renderDescription()}
        {renderOrderStatus()}
      </ScrollView>
    );
  };

  const renderButton = (title: string = t('chat_support'), danger: boolean = false) => {
    return (
      <View style={{ paddingHorizontal: 20, paddingBottom: 10, paddingTop: 5 }}>
        <components.Button title={title} danger={danger} onPress={() => { }} />
      </View>
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
      {renderButton()}
      {status == "Processing" && (
        renderButton(t('unorder'), true)
      )}

      {renderHomeIndicator()}
    </components.SmartView>
  );
};

export default TrackYourOrder;
