<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <title>간단한 지도 표시하기</title>
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=qxcakk5lqj"></script>
</head>
<body>
<div id="map" style="width:100%;height:400px;"></div>

<script>

var map = new naver.maps.Map('map', {
    center: new naver.maps.LatLng(37.2890174173061, 127.19520435615891),
    zoom: 10
});

var jeju = new naver.maps.LatLng(33.3590628, 126.534361),
    busan = new naver.maps.LatLng(35.1797865, 129.0750194),
    dokdo = new naver.maps.LatLngBounds(
                new naver.maps.LatLng(37.2380651, 131.8562652),
                new naver.maps.LatLng(37.2444436, 131.8786475)),
    seoul = new naver.maps.LatLngBounds(
                new naver.maps.LatLng(37.42829747263545, 126.76620435615891),
                new naver.maps.LatLng(37.7010174173061, 127.18379493229875));

$("#to-jeju").on("click", function(e) {
    e.preventDefault();

    map.setCenter(jeju);
});

$("#to-1").on("click", function(e) {
    e.preventDefault();

    map.setZoom(6, true);
});

$("#to-dokdo").on("click", function(e) {
    e.preventDefault();

    map.fitBounds(dokdo);
});

$("#to-busan").on("click", function(e) {
    e.preventDefault();

    map.panTo(busan);
});

$("#to-seoul").on("click", function(e) {
    e.preventDefault();

    map.panToBounds(seoul);
});

$("#panBy").on("click", function(e) {
    e.preventDefault();

    map.panBy(new naver.maps.Point(10, 10));
});
</script>
<script src="/~team5/js/jquery.min.js"></script>
  <script src="/~team5/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="/~team5/js/popper.min.js"></script>
  <script src="/~team5/js/bootstrap.min.js"></script>
  <script src="/~team5/js/jquery.easing.1.3.js"></script>
  <script src="/~team5/js/jquery.waypoints.min.js"></script>
  <script src="/~team5/js/jquery.stellar.min.js"></script>
  <script src="/~team5/js/owl.carousel.min.js"></script>
  <script src="/~team5/js/jquery.magnific-popup.min.js"></script>
  <script src="/~team5/js/aos.js"></script>
  <script src="/~team5/js/jquery.animateNumber.min.js"></script>

</body>
</html>

