const path = require("path");

const files = {
  theme: "./src/js/index.js",
};

const moduleConfig = {
  rules: [
    {
      test: /\.js$/i,
      use: "babel-loader"
    },
    {
      test: /\.css$/i,
      use: ["style-loader", "css-loader"]
    },
  ],
}

const outputConfig = {
  path: path.resolve(__dirname, "assets/scripts"),
  filename: "[name].js",
};

module.exports = [
  {
    name: "general",
    mode: "development",
    entry: files,
    output: outputConfig,
    module: moduleConfig
  },
  {
    name: "general:build",
    mode: "production",
    entry: files,
    output: outputConfig,
    module: moduleConfig
  },
];
