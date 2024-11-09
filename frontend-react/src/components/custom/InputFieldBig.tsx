import {View, Text, TextInput} from 'react-native';
import React from 'react';

import {theme} from '../../constants';

type Props = {
  containerStyle?: object;
  placeholder?: string;
  onChangeText?: (text: string) => void;
  value?: string;
};

const InputFieldBig: React.FC<Props> = ({placeholder,containerStyle, onChangeText, value}): JSX.Element => {
  return (
    <View
      style={{
        width: '100%',
        height: 131,
        backgroundColor: '#E9F3F6',
        borderRadius: 10,
        ...containerStyle,
      }}
    >
      <TextInput
        style={{
          width: '100%',
          height: '100%',
          paddingHorizontal: 24,
          paddingTop: 14,
          paddingBottom: 14,
          color: theme.colors.mainColor,
          ...theme.fonts.DMSans_400Regular,
          fontSize: 16,
        }}
        placeholder={placeholder}
        value={value}
        onChangeText={onChangeText}
        textAlignVertical='top'
        multiline={true}
        placeholderTextColor='#A8BCCC'
      />
    </View>
  );
};

export default InputFieldBig;
