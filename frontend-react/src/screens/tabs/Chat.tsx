import React, { useState } from 'react';
import {
    ScrollView,
    Text,
    TextInput,
    TextStyle,
    TouchableOpacity,
    View,
    ViewStyle
} from 'react-native';

import { Path, Svg } from 'react-native-svg';
import { svg } from '../../assets/svg';
import { components } from '../../components';
import { theme } from '../../constants';
import { useAppNavigation } from '../../hooks';
import { homeIndicatorHeight } from '../../utils';
import BottomTabBar from '../../navigation/BottomTabBar';
import { MessageType } from '../../types';
import Image from '../../components/custom/Image';

const Chat: React.FC = (): JSX.Element => {
    const navigation = useAppNavigation();

    const [message, setMessage] = useState("");
    const [messages, setMessages] = useState<MessageType[]>([{ name: "Duc", content: "nguuuuuu", role: "BISBOSES" }]);

    const handleSendMessage = () => {
        if (message.trim()) {
            setMessages([...messages, { name: "Client", content: message }, { name: "Duc", content: "test clll", role: "BISBOSES" }])
            setMessage("");
        }
    }

    const renderStatusBar = () => {
        return <components.StatusBar />;
    };

    const renderHeader = () => {
        return (
            <components.Header
                goBack={true}
                title='Chat Support'
                phone={true}
                bottomLine={true}
            />
        );
    };

    const renderContent = () => {
        // if (carouselLoading || categoriesLoading || productsLoading) {
        //   return <components.Loader />;
        // }
        return (
            <ScrollView
                contentContainerStyle={{
                    flexGrow: 1,
                    justifyContent: 'flex-end',
                    paddingHorizontal: 10,
                    paddingVertical: 5,
                }}
                showsVerticalScrollIndicator={false}
            >
                {renderMessage()}
            </ScrollView>
        );
    };

    const renderMessage = () => {
        if (messages.length > 0) {
            return (messages.map((message, index) => {
                const boxStyle: ViewStyle = {
                    flexDirection: 'row',
                    gap: 10,
                    alignItems: 'flex-start',
                    alignSelf: message.role == 'BISBOSES' ? 'flex-start' : 'flex-end',
                    margin: 5,
                };
                const textStyle: TextStyle = {
                    backgroundColor: message.role == 'BISBOSES' ? '#E9F3F6' : theme.colors.mainTurquoise,
                    borderRadius: 25,
                    borderTopEndRadius: message.role == 'BISBOSES' ? 25 : 0,
                    borderTopStartRadius: message.role == 'BISBOSES' ? 0 : 25,
                    paddingHorizontal: 15,
                    paddingVertical: 8,
                    maxWidth: 250,
                    fontSize: 19,
                    ...theme.fonts.DMSans_500Medium,
                    color: message.role == 'BISBOSES' ? 'black' : theme.colors.white,
                };
                return (
                    <View key={'message' + index} style={boxStyle}>
                        <Image
                            source={{ uri: message.role == 'BISBOSES' ? 'https://george-fx.github.io/dine-hub/10.jpg' : '' }}
                            style={{
                                width: message.role == 'BISBOSES' ? 40 : 0,
                                height: message.role == 'BISBOSES' ? 40 : 0,
                                borderRadius: 50,
                            }}
                        />
                        <Text style={textStyle}>{message.content}</Text>
                    </View>

                );
            }))
        }

        return null;
    };

    const SendSvg: React.FC = () => {
        return (
            <Svg
                width={35}
                height={35}
                fill="none"
                viewBox="0 0 24 24"
            >
                <Path
                    d="m10.3 13.695 9.802-9.798m-9.523 10.239 2.223 4.444c.537 1.075.806 1.612 1.144 1.756a1 1 0 0 0 .903-.061c.316-.188.51-.757.898-1.893l4.2-12.298c.338-.99.506-1.485.39-1.813a1 1 0 0 0-.609-.61c-.328-.115-.823.054-1.813.392l-12.297 4.2c-1.137.387-1.705.581-1.893.897a1 1 0 0 0-.061.904c.144.338.681.607 1.755 1.143l4.445 2.223c.177.088.265.133.342.192a1 1 0 0 1 .182.181c.059.077.103.166.191.343Z"
                    stroke={message.trim() ? "#00B0B9" : "#000"}
                    strokeWidth={2}
                    strokeLinecap="round"
                    strokeLinejoin="round"
                />
            </Svg>
        )
    }

    const renderBottomTabBar = () => {
        const containerStyle: ViewStyle = {
            backgroundColor: theme.colors.white,
            flexDirection: 'row',
            gap: 7,
            paddingTop: 15,
            paddingBottom: 12,
            paddingHorizontal: 20,
            borderRadius: 10,
            justifyContent: 'space-between',
            alignItems: 'center',
            marginBottom: homeIndicatorHeight() === 0 ? 20 : 10,
        };

        return (
            <View style={containerStyle}>
                <TouchableOpacity
                    style={{
                        alignItems: 'center',
                        margin: 5,
                        borderRadius: 50,
                    }}
                    onPress={() => { }}
                >
                    <svg.PictureSvg />
                </TouchableOpacity>

                <TextInput
                    style={{
                        flexGrow: 1,
                        height: '100%',
                        flexDirection: 'row',
                        justifyContent: 'space-between',
                        fontSize: 16,
                        marginLeft: 4,
                        paddingLeft: 15,
                        color: theme.colors.mainColor,
                        ...theme.fonts.DMSans_400Regular,
                        backgroundColor: '#E9F3F6',
                        borderColor: '#DBE9F5',
                        borderRadius: 15,
                    }}
                    placeholder="Let talk !"
                    placeholderTextColor={'#A7AFB7'}
                    value={message}
                    onChangeText={(text) => setMessage(text)}
                />
                <TouchableOpacity
                    style={{
                        alignItems: 'center',
                        margin: 5,
                        borderRadius: 50,
                    }}
                    onPress={() => { handleSendMessage() }}
                >
                    <SendSvg />
                </TouchableOpacity>
            </View >
        );
    };

    // const renderBottomTabBar = () => {
    //     return <BottomTabBar />;
    // };
    const renderHomeIndicator = () => {
        return <components.HomeIndicator />;
    };

    return (
        <components.SmartView>
            {renderStatusBar()}
            {renderHeader()}
            {renderContent()}
            {renderBottomTabBar()}
            {renderHomeIndicator()}
        </components.SmartView>
    );
};

export default Chat;