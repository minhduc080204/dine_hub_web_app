import React from 'react';
import {Image as RNImage} from 'react-native';
import type {ImageSourcePropType} from 'react-native';
import { BASE_URL, ENDPOINTS } from '../../config';

type Props = {
  source: {uri: string};
  style?: object;
  imageStyle?: object;
  resizeMode?: 'cover' | 'contain' | 'stretch';
  tintColor?: string;
  isQR?: boolean;
};

const Image: React.FC<Props> = ({
  source,
  style,
  resizeMode,
  tintColor,
}): JSX.Element => {
  return (
    <RNImage
      style={style}
      source={source as ImageSourcePropType}
      tintColor={tintColor}
    />
  );
};

export default Image;
