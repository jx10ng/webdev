( function( api ) {

	// Extends our custom "business-park" section.
	api.sectionConstructor['business-park'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
