FROM node:16.20.2-alpine

WORKDIR /client

COPY package.json package.json
COPY ./assets ./assets
COPY ./src ./src
COPY .prettierrc.js .prettierrc.js
COPY app.json app.json
COPY App.tsx App.tsx
COPY babel.config.js babel.config.js
COPY tsconfig.json tsconfig.json

RUN npm install 

EXPOSE 19006
    

CMD ["npm", "run", "web"]