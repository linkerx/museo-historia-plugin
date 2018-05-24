
		var map = L.map('map').setView([41.7896,-87.5996], 15),
			drawnItems = new L.FeatureGroup().addTo(map),
			editActions = [
                LeafletToolbar.EditAction.Popup.Edit,
                LeafletToolbar.EditAction.Popup.Delete,
				LeafletToolbar.ToolbarAction.extendOptions({
					toolbarIcon: {
						className: 'leaflet-color-picker',
						html: '<span class="fa fa-eyedropper"></span>'
					},
					subToolbar: new LeafletToolbar({ actions: [
						L.ColorPicker.extendOptions({ color: '#db1d0f' }),
						L.ColorPicker.extendOptions({ color: '#025100' }),
						L.ColorPicker.extendOptions({ color: '#ffff00' }),
						L.ColorPicker.extendOptions({ color: '#0000ff' })
					]})
				})
			];

		L.tileLayer("http://tile.stamen.com/terrain/{z}/{x}/{y}.jpg", {
			attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">OpenStreetMap</a>, under <a href="http://creativecommons.org/licenses/by-sa/3.0">CC BY SA</a>.'
		}).addTo(map);

		new LeafletToolbar.DrawToolbar({
			position: 'topleft',
		}).addTo(map);

		map.on('draw:created', function(evt) {
			var	type = evt.layerType,
				layer = evt.layer;

			drawnItems.addLayer(layer);

			layer.on('click', function(event) {
				new LeafletToolbar.EditToolbar.Popup(event.latlng, {
					actions: editActions
				}).addTo(map, layer);
			});
		});
