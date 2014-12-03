
function initialize() {//地図の初期化処理
  var mapOptions = { 
    center: new google.maps.LatLng(-33.8688, 151.2195),
    zoom: 19,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById('map-canvas'),
    mapOptions);

  var input = /** @type {HTMLInputElement} */(document.getElementById('searchTextField'));
  var autocomplete = new google.maps.places.Autocomplete(input);//inputにオートコンプリートをつける

  autocomplete.bindTo('bounds', map);

  var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({//マーカーを作成
    map: map,
    draggable: true 
  });

  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    infowindow.close();//情報ウインドウを閉じる
    marker.setVisible(false);//見えなくする
    input.className = '';//空白にする
    var place = autocomplete.getPlace();//選択された場所の位置情報
    if (!place.geometry) {//場所情報がなかったら。
      // Inform the user that the place was not found and return.
      input.className = 'notfound';
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {//もし位置情報が入っていたら
      map.fitBounds(place.geometry.viewport);//位置情報に座標を合せる
    } else {
      map.setCenter(place.geometry.location);//viewpointがなければ位置情報を中心にする
      map.setZoom(17);  // Why 17? Because it looks good.
    }
    marker.setIcon(/** @type {google.maps.Icon} */({//マーカーの画像ををセットする。
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(35, 35)
    }));
    marker.setPosition(place.geometry.location);//選択した場所にマーカーを設置
    marker.setVisible(true);//見えるようにする
    latlng=marker.getPosition();//マーカーの座標を所得
    var lat=latlng.lat();//座標を保存しておく
    var lng=latlng.lng();//座標を保存しておく
    $('#lat').val(lat);//座標をhiddeｎにセット
    $('#lng').val(lng);
function getlocAddress(pos) {//座標から住所所得する
	
	var geocoder=new google.maps.Geocoder();
	geocoder.geocode({latLng: pos},
		function(results,status){
			if(status == google.maps.GeocoderStatus.OK)
			{
				if(results[0].geometry){
				
					var positionname = results[0].formatted_address.replace(/^日本, /, '');
					$('#mapAddress').val(positionname);//座標をhiddeｎにセット
				}
				
			}
		})
	}
getlocAddress(latlng);
    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),//アドレス情報に両方の情報が入っていれば、それをいれる。そうでなければ空欄
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');//joinで繋ぐ
    }

    infowindow.setContent("<br>ドラッグでマーカーを移動できます。集合場所に移動させてください。<br>");//インフォウインドウに場所の名前をいれる
    infowindow.open(map, marker);
  });
    infowindow.setContent("<br>ドラッグでマーカーを移動できます。集合場所に移動させてください。<br>");//インフォウインドウに場所の名前をいれる
    infowindow.open(map, marker);
  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  function setupClickListener(id, types) {
    var radioButton = document.getElementById(id);
    google.maps.event.addDomListener(radioButton, 'click', function() {
      autocomplete.setTypes(types);//ラジオボタンがクリックされたらtype（空白かestablishmentかgeocode)を付与する
    });
  }

  setupClickListener('changetype-all', []);//changetype-allに空白タイプを追加
  setupClickListener('changetype-establishment', ['establishment']);//changetype-allに空白タイプを追加
  setupClickListener('changetype-geocode', ['geocode']);//changetype-geocodeにgeocodeタイプを追加
}

google.maps.event.addDomListener(window, 'load', initialize);//windowがロードされた
