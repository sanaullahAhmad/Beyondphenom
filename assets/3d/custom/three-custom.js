		var canvas;

		var camera, scene, renderer;

		var mouseX = 0, mouseY = 0;

		var windowHalfX = window.innerWidth / 2;
		var windowHalfY = window.innerHeight / 2;
		function loaders(mtl, obj)
		{
			var manager = new THREE.LoadingManager();
			manager.onProgress = function ( item, loaded, total ) {

				console.log( item, loaded, total );

			};

			var onProgress = function ( xhr ) {
				if ( xhr.lengthComputable ) {
					var percentComplete = xhr.loaded / xhr.total * 100;
					console.log( Math.round(percentComplete, 2) + '% downloaded' );
				}
			};

			var onError = function ( xhr ) { };

			THREE.Loader.Handlers.add( /\.dds$/i, new THREE.DDSLoader() );

			var mtlLoader = new THREE.MTLLoader();
			mtlLoader.setPath( '../public//uploads/product_categories/'+productss+'/' );

			mtlLoader.load( mtl, function( materials ) {

				materials.preload();

				var objLoader = new THREE.OBJLoader();
				objLoader.setMaterials( materials );
				objLoader.setPath( '../public/uploads/product_categories/'+productss+'/' );
				objLoader.load( obj, function ( object ) {

					$('#loading').hide();
					object.position.y = - 8;
					object.position.z = 0;
					scene.add( object );

				}, onProgress, onError );

			});
		}

		init(model_mtl+'.mtl', model_obj+'.obj');
		animate();


		function init(mtl, obj) {

			canvas = document.getElementById( 'tjs' );

			camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 1, 70 );
			camera.position.z = -400;


				// scene

				scene = new THREE.Scene();

				// var ambient = new THREE.AmbientLight( 0x101030 );
				// scene.add( ambient );

				var directionalLight = new THREE.DirectionalLight( 0xffffff, 0.8 );
				directionalLight.position.set( -10, -10, -25 );
				scene.add( directionalLight );

				// var light = new THREE.DirectionalLight( 0xffffff, 0.8);
				// light.position.set( -1, -1, -3 ).normalize();
				// scene.add( light );

				var light = new THREE.DirectionalLight( 0xffffff, 0.6);
				light.position.set( 5, 5, -3 ).normalize();
				scene.add( light );

				var light = new THREE.DirectionalLight( 0xffffff, 0.8);
				light.position.set( 0, 10, 25 ).normalize();
				scene.add( light );

				// texture

				//loaders
				loaders(mtl, obj);

				//

				renderer = new THREE.WebGLRenderer({canvas: canvas, antialias: false,alpha:true});
				

				controls = new THREE.OrbitControls(camera, renderer.domElement);
//////////CHANGE THESE
controls.minDistance = 7;
controls.maxDistance = 12;

controls.minPolarAngle = Math.PI/2; 
controls.maxPolarAngle = Math.PI/2; 
controls.center.set(0,0,0);


canvas.width  = canvas.clientWidth;
canvas.height = canvas.clientHeight;
renderer.setViewport(0, 0, canvas.clientWidth, canvas.clientHeight);

renderer.setPixelRatio( window.devicePixelRatio );
renderer.setSize( canvas.clientWidth, canvas.clientHeight );				


				// document.addEventListener( 'mousemove', onDocumentMouseMove, false );


			}

			function onWindowResize() {

				windowHalfX = window.innerWidth / 2;
				windowHalfY = window.innerHeight / 2;

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( canvas.clientWidth, canvas.clientHeight );

			}

			// function onDocumentMouseMove( event ) {

			// 	mouseX = ( event.clientX - windowHalfX ) / 5;
			// 	// mouseY = ( event.clientY - windowHalfY ) / 5;

			// }

			//

			function animate() {

				requestAnimationFrame( animate );
				renderer.render(scene, camera);
				controls.update();

			}

			function render() {

				camera.position.x += ( mouseX - camera.position.x ) * .01;
				camera.position.y += ( - mouseY - camera.position.y ) * .01;

				camera.lookAt( scene.position );

				renderer.render( scene, camera );

			}


			$('.design1').on('click', function(event) {
				event.preventDefault();
				$('canvas').remove();
				$('#loading').show();
				init('shorts2.mtl', 'shorts2.obj');
				animate();
			});

			$('.design2').on('click', function(event) {
				event.preventDefault();
				$('canvas').remove();
				$('#loading').show();
				init('shorts2.mtl', 'shorts2.obj');
				animate();
			});
