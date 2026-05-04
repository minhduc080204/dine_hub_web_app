import React, { useEffect, useRef } from "react";
import { Animated, Text, StyleSheet, TextStyle } from "react-native";

export default function TypingFade({style}:{style:TextStyle}) {
  const opacity = useRef(new Animated.Value(0)).current;

  useEffect(() => {
    const anim = Animated.loop(
      Animated.sequence([
        Animated.timing(opacity, {
          toValue: 1,
          duration: 500,
          useNativeDriver: true
        }),
        Animated.timing(opacity, {
          toValue: 0.3,
          duration: 500,
          useNativeDriver: true
        })
      ])
    );

    anim.start();
    return () => anim.stop();
  }, []);

  return (
    <Animated.Text style={[style, { opacity }]}>
      Eatzy đang nhập...
    </Animated.Text>
  );
}

const styles = StyleSheet.create({
  text: {
    fontStyle: "italic",
    color: "#888"
  }
});
