module.exports = {
	map: false,
	plugins: [
		require(`postcss-import`),
		require(`postcss-assets`),
		require(`postcss-focus`),
		require(`postcss-will-change`),
		require(`autoprefixer`)({
			cascade: true,
			flexbox: false,
			grid: true
		})
	]
};