import { TouchableOpacity, View, ViewStyle } from "react-native";
import LanguageSvg from "../assets/svg/LanguageSvg";
import H3 from "../text/H3";
import H4 from "../text/H4";
import VietNamSvg from "../assets/svg/VietNamSvg";
import AmericaSvg from "../assets/svg/AmericaSvg";
import { theme } from "../constants";
import i18n from "../../i18n";
import { useState } from "react";

const ChangeLanguage: React.FC = (): JSX.Element => {
    
    const changeLanguage = (lang: string) => {
        i18n.changeLanguage(lang);
    };
    const style: ViewStyle = {
        display: 'flex',
        flexDirection: "row",
        alignItems: 'center',
        gap: 5,
        paddingVertical: 4,
        paddingHorizontal: 8,
    }

    const border: ViewStyle = {
        borderWidth: 2,
        borderRadius: 25,
        borderColor: theme.colors.lightBlue
    }
    return (
        <View
            style={{
                display: 'flex',
                flexDirection: "row",
                alignItems: 'center',
                justifyContent: "space-around"
            }}
        >
            <View style={{
                ...border,
                borderColor: i18n.language == 'vi' ? theme.colors.lightBlue : theme.colors.mainTurquoise
            }} >
                <TouchableOpacity style={style} onPress={()=>changeLanguage('en')}>
                    <AmericaSvg />
                    <H4>English</H4>
                </TouchableOpacity>
            </View>
            <View style={{
                ...border,
                borderColor: i18n.language == 'en' ? theme.colors.lightBlue : theme.colors.mainTurquoise
            }} >
                <TouchableOpacity style={style} onPress={()=>changeLanguage('vi')}>
                    <VietNamSvg />
                    <H4>Tiếng Việt</H4>
                </TouchableOpacity>
            </View>
        </View>

    );
};

export default ChangeLanguage;
