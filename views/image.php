<!DOCTYPE html>
<html lang="ja">
  <head>
    <title><?php echo $title; ?> - 今日のパノラマ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <style>
      body {
        margin: 0px;
      }
    </style>
    <base href="<?php echo $base_path; ?>">
  </head>
  <body>
  <div id="stage" style="overflow: hidden;"></div>
  <script src="js/threejs/three.min.js"></script>
  <script src="js/threejs//DeviceOrientationControls.js"></script>
  <script src="js/threejs//OrbitControls.js"></script>
  <script>
(function(){

  // var ua = navigator.userAgent;
  //   if (ua.indexOf('iPhone') > 0 || ua.indexOf('iPod') > 0 || ua.indexOf('Android') > 0) {
  //       var sp = true;
  //   }else if(ua.indexOf('iPad') > 0 || ua.indexOf('Android') > 0){
  //       var sp = true;
  //   }

  var width = window.innerWidth,
      height = window.innerHeight;

  //scene

  var scene = new THREE.Scene();

  //mesh

  var geometry = new THREE.SphereGeometry( 5, 60, 40, <?php echo $phiStart; ?>);
	geometry.scale( - 1, 1, 1 );

	var material = new THREE.MeshBasicMaterial( {
	   map: THREE.ImageUtils.loadTexture( '<?php echo $image; ?>' )
	} );

	sphere = new THREE.Mesh( geometry, material );

	scene.add( sphere );

  //camera

  var camera = new THREE.PerspectiveCamera(75, width / height, 1, 1000);
  camera.position.set(0,0,0.1);
  camera.lookAt(sphere.position);

//  sphere.rotation.x = -0.4;

//   //helper
// 
//   var axis = new THREE.AxisHelper(1000);
//   axis.position.set(0,0,0);
//   scene.add(axis);

  //render

  var renderer = new THREE.WebGLRenderer();
  renderer.setSize(width,height);
  renderer.setClearColor({color: 0x000000});
  document.getElementById('stage').appendChild(renderer.domElement);
  renderer.render(scene,camera);

  //control

  // if(sp){
  //   var gcontrols = new THREE.DeviceOrientationControls(camera, renderer.domElement);
  // }else{
    var controls = new THREE.OrbitControls(camera, renderer.domElement);
  // }

  function render(){
    requestAnimationFrame(render);
    window.addEventListener( 'resize', onWindowResize, false );
    renderer.render(scene,camera);

    // if(sp){
    //   gcontrols.connect();
    //   gcontrols.update();
    // }else{
      sphere.rotation.y += 0.05 * Math.PI/180;
      controls.update();
    // }
  }
  render();
  function onWindowResize() {
		camera.aspect = window.innerWidth / window.innerHeight;
		camera.updateProjectionMatrix();
		renderer.setSize( window.innerWidth, window.innerHeight );
	}

})();


  </script>
  </body>
</html>
