function myColumnBgColorOptions( bgColorOptions ) {
	bgColorOptions.push( {
		name: 'success',
		color: '#FE7314',
	} );
	bgColorOptions.push( {
		name: 'light',
		color: '#f2f8fd',
	} );
	return bgColorOptions;
}
wp.hooks.addFilter(
	'wpBootstrapBlocks.column.bgColorOptions',
	'myplugin/wp-bootstrap-blocks/column/bgColorOptions',
	myColumnBgColorOptions
);