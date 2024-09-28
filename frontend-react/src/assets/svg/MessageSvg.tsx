import * as React from "react"
import Svg, { G, Path, Defs, ClipPath } from "react-native-svg"

const MessageSvg: React.FC = (): JSX.Element => (
    <Svg
        width={40}
        height={40}
        viewBox="0 0 24 24"
        fill="none"
    >
        <G clipPath="url(#clip0_8_53)" fill="#000">
            <Path d="M16 12a1 1 0 0 1-.38-.07 1.06 1.06 0 0 1-.33-.22c-.09-.092-.161-.2-.21-.32A1.09 1.09 0 0 1 15 11a1 1 0 0 1 2 0 1.09 1.09 0 0 1-.08.39c-.049.12-.12.228-.21.32A1.002 1.002 0 0 1 16 12ZM12 12a1 1 0 0 1-.38-.07 1.06 1.06 0 0 1-.33-.22c-.09-.092-.161-.2-.21-.32A1.09 1.09 0 0 1 11 11a1 1 0 0 1 2 0 1.09 1.09 0 0 1-.08.39c-.049.12-.12.228-.21.32A1.002 1.002 0 0 1 12 12ZM8 12a1 1 0 0 1-.38-.07 1.06 1.06 0 0 1-.33-.22 1 1 0 0 1-.21-.32A1.09 1.09 0 0 1 7 11a1 1 0 0 1 2 0 1.09 1.09 0 0 1-.08.39 1 1 0 0 1-.21.32A1.002 1.002 0 0 1 8 12Z" />
        </G>
        <Path
            d="M5 16.55v3.35a2.1 2.1 0 0 0 3.54 1.53l2.61-2.46h.87c5.52 0 10-3.8 10-8.5s-4.48-8.5-10-8.5-10 3.81-10 8.5a7.93 7.93 0 0 0 3 6.06l-.02.02Z"
            stroke="#000"
            strokeWidth={1.5}
            strokeLinecap="round"
            strokeLinejoin="round"
        />
        <Defs>
            <ClipPath id="clip0_8_53">
                <Path fill="#fff" transform="translate(7 10)" d="M0 0h10v2H0z" />
            </ClipPath>
        </Defs>
    </Svg>
)

export default MessageSvg
