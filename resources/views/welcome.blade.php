<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- displays site properly based on user's device -->

    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="https://res.cloudinary.com/codelifings/image/upload/v1596531968/ice-cream_tv7wto.png"
    />

    <title>
      Simpleazy | Web App for Treasurer in The School
    </title>

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    />
    <link rel="stylesheet" href="style.css" />
    <style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans|Poppins:400,700&display=swap');

* {
	box-sizing: border-box;
}

body {
	background-image: url('./images/bg-desktop.svg');
	background-repeat: no-repeat;
	background-size: cover;
	background-color: hsl(257, 40%, 49%);
	color: #fff;
	display: flex;
	font-family: 'Open sans', sans-serif;
	font-size: 1.4em;
	align-items: center;
	justify-content: center;
	min-height: 100vh;
	-webkit-animation: slide-in-blurred-top 0.6s cubic-bezier(0.230, 1.000, 0.320, 1.000) both;
	        animation: slide-in-blurred-top 0.6s cubic-bezier(0.230, 1.000, 0.320, 1.000) both;
}
@-webkit-keyframes slide-in-blurred-top {
  0% {
    -webkit-transform: translateY(-1000px) scaleY(2.5) scaleX(0.2);
            transform: translateY(-1000px) scaleY(2.5) scaleX(0.2);
    -webkit-transform-origin: 50% 0%;
            transform-origin: 50% 0%;
    -webkit-filter: blur(40px);
            filter: blur(40px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateY(0) scaleY(1) scaleX(1);
            transform: translateY(0) scaleY(1) scaleX(1);
    -webkit-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
    -webkit-filter: blur(0);
            filter: blur(0);
    opacity: 1;
  }
}
@keyframes slide-in-blurred-top {
  0% {
    -webkit-transform: translateY(-1000px) scaleY(2.5) scaleX(0.2);
            transform: translateY(-1000px) scaleY(2.5) scaleX(0.2);
    -webkit-transform-origin: 50% 0%;
            transform-origin: 50% 0%;
    -webkit-filter: blur(40px);
            filter: blur(40px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateY(0) scaleY(1) scaleX(1);
            transform: translateY(0) scaleY(1) scaleX(1);
    -webkit-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
    -webkit-filter: blur(0);
            filter: blur(0);
    opacity: 1;
  }
}


h1 {
	font-family: 'Poppins', sans-serif;
}

p {
	opacity: 0.8;
}

img {
	max-width: 100%;
}

.container {
	margin: auto;
	max-width: 100%;
	width: 1200px;
}

button:hover{
	background: hsl(257, 40%, 49%);
	color: white;
	border: 2px solid white;
	position: relative;
}
button:active{
	-webkit-animation: flip-2-hor-top-1 0.5s cubic-bezier(0.455, 0.030, 0.515, 0.955) both;
	animation: flip-2-hor-top-1 0.5s cubic-bezier(0.455, 0.030, 0.515, 0.955) both;
}
@-webkit-keyframes flip-2-hor-top-1 {
  0% {
    -webkit-transform: translateY(0) rotateX(0);
            transform: translateY(0) rotateX(0);
    -webkit-transform-origin: 50% 0%;
            transform-origin: 50% 0%;
  }
  100% {
    -webkit-transform: translateY(-100%) rotateX(-180deg);
            transform: translateY(-100%) rotateX(-180deg);
    -webkit-transform-origin: 50% 100%;
            transform-origin: 50% 100%;
  }
}
@keyframes flip-2-hor-top-1 {
  0% {
    -webkit-transform: translateY(0) rotateX(0);
            transform: translateY(0) rotateX(0);
    -webkit-transform-origin: 50% 0%;
            transform-origin: 50% 0%;
  }
  100% {
    -webkit-transform: translateY(-100%) rotateX(-180deg);
            transform: translateY(-100%) rotateX(-180deg);
    -webkit-transform-origin: 50% 100%;
            transform-origin: 50% 100%;
  }
}

.flex {
	display: flex;
	margin: 100px 0;
}

.flex > div:first-child {
	flex: 0.6;
	margin-right: 20px;
}

.flex > div:last-child {
	flex: 0.4;
	margin-left: 20px;
}

button {
	background-color: #fff;
	border-radius: 50px;
	position: relative;
	border: none;
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
	color: hsl(257, 40%, 49%);
	font-size: 24px;
	padding: 20px 80px;
}

.social-links {
	display: flex;
	justify-content: flex-end;
	padding: 0;
	list-style-type: none;
}

.social-links a {
	border-radius: 50%;
	border: 2px solid #fff;
	color: #fff;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	margin-left: 20px;
	height: 50px;
	width: 50px;
	text-decoration: none;
}

@media screen and (max-width: 768px) {
	.flex {
		flex-direction: column;
		margin: 50px 0;
	}

	.flex > div:first-child {
		flex: 1;
		margin-right: 0;
	}

	.flex > div:last-child {
		flex: 1;
		margin-left: 0;
		text-align: center;
	}

	.social-links {
		justify-content: center;
	}
}
</style>
  </head>
  <body>
    <div class="container">
      <div style="display: flex; flex-direction: row;">
        <img
          src="https://res.cloudinary.com/codelifings/image/upload/v1596531968/ice-cream_tv7wto.png"
          style="width: 49pt; height: 49pt;"
          alt="logo"
        />
        <h1 style="margin-top: -2px;">Simpleazy</h1>
      </div>
      <div class="flex">
       <div>
          <img src="./illustration-mockups.svg" alt="illustration" />
        </div>

        <div>
          <h1>Manage Your Cash in The School, Easily!</h1>
          <p>
            Process treasurer financial records regularly accurately without
            hassle. Make sure your supervisor can monitor it and you will always
            be reminded to collect cash. You can easily check who haven't paid
            cash easily, Right here!
          </p>
          <a href="{{ route('login') }}"><button>Get Started</button></a>
        </div>
      </div>

      <ul class="social-links">
        <li>
          <a href="#">
            <i class="fab fa-facebook-f"></i>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fab fa-twitter"></i>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fab fa-instagram"></i>
          </a>
        </li>
      </ul>
    </div>

    <script>
    const projects = [
	{
		name: 'four-card-feature-section-master',
		youtube:
			'https://www.youtube.com/watch?v=PcSUEo0P0GU&list=PLgBH1CvjOA63Xvt0BaeQ7zL4KXX96Wbgp&index=2&t=0s'
	},
	{
		name: 'base-apparel-coming-soon-master',
		youtube:
			'https://www.youtube.com/watch?v=8A7-0gsbHA0&list=PLgBH1CvjOA63Xvt0BaeQ7zL4KXX96Wbgp&index=3&t=0s'
	},
	{
		name: 'signup-form-master',
		youtube:
			'https://www.youtube.com/watch?v=bFOuUypjkSM&list=PLgBH1CvjOA63Xvt0BaeQ7zL4KXX96Wbgp&index=4&t=0s'
	},
	{
		name: 'single-price-grid-component-master',
		youtube:
			'https://www.youtube.com/watch?v=pbsvhVPFHX0&list=PLgBH1CvjOA63Xvt0BaeQ7zL4KXX96Wbgp&index=5&t=0s'
	},
	{
		name: 'ping-coming-soon-page-master',
		youtube:
			'https://www.youtube.com/watch?v=kvsmBV19Sz0&list=PLgBH1CvjOA63Xvt0BaeQ7zL4KXX96Wbgp&index=6&t=0s'
	},
	{
		name: 'huddle-landing-page',
		youtube:
			'https://www.youtube.com/watch?v=wnb-BfjR-oo&list=PLgBH1CvjOA63Xvt0BaeQ7zL4KXX96Wbgp&index=7&t=0s'
	},
	{
		name: 'huddle-simple-landing',
		youtube:
			'https://www.youtube.com/watch?v=ObrYwPRyeqc&list=PLgBH1CvjOA63Xvt0BaeQ7zL4KXX96Wbgp&index=8&t=0s'
	},
	{
		name: 'fylo-landing-page',
		youtube:
			'https://www.youtube.com/watch?v=a9-Ro9rc7E4&list=PLgBH1CvjOA63Xvt0BaeQ7zL4KXX96Wbgp&index=9&t=0s'
	},
	{
		name: 'insure-landing-page',
		youtube:
			'https://www.youtube.com/watch?v=9HVKR_hK0nY&list=PLgBH1CvjOA63Xvt0BaeQ7zL4KXX96Wbgp&index=10&t=0s'
	},
	{
		name: 'pricing-toggle-component',
		youtube:
			'https://www.youtube.com/watch?v=NBkD-O7f4Bs&list=PLgBH1CvjOA63Xvt0BaeQ7zL4KXX96Wbgp&index=11&t=0s'
	},
	{
		name: 'tracking-info',
		youtube:
			'https://www.youtube.com/watch?v=71HM728Mul4&list=PLgBH1CvjOA63Xvt0BaeQ7zL4KXX96Wbgp&index=11&t=0s'
	},
	{
		name: 'clipboard-landing-page',
		youtube:
			'https://www.youtube.com/watch?v=aZeKU7xoT0w&list=PLgBH1CvjOA63Xvt0BaeQ7zL4KXX96Wbgp&index=11&t=0s'
	}
];

const list = document.getElementById('list');

projects.forEach(({ name, youtube }, i) => {
	const listItem = document.createElement('li');

	listItem.innerHTML = `
		<a href="/${name}/index.html">
			<img src="/${name}/design/desktop-design.jpg" alt="${name}" />
			<p>${i + 1}. ${formatProjectName(name)}</p>
		</a>

		<div class="links-container">
			<a href="/${name}/index.html" class="blue">
				<i class="fas fa-eye"></i>
			</a>
			<a href="${youtube}" class="youtube">
				<i class="fab fa-youtube"></i>
			</a>
		</div>
	`;

	list.appendChild(listItem);
});

function formatProjectName(name) {
	return name
		.split('-')
		.map(word => word[0].toUpperCase() + word.slice(1))
		.join(' ');
}
</script>
  </body>
</html>
