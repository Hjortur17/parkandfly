<template>
	<nav class="absolute inset-x-0 top-0 container max-w-4xl mx-auto mt-10 px-6">
		<ul class="flex justify-between">
			<li>
				<a href="/">
					<h1>
						<img src="/images/logo.png" width="200px">
					</h1>
				</a>
			</li>
			<li class="self-center">
				<div class="button_container" id="toggle" :class="{'active': isActive}" @click="toggleMenu">
					<span class="top"></span>
					<span class="middle"></span>
					<span class="bottom"></span>
				</div>

				<div class="overlay" id="overlay" :class="{'open': isActive}">
					<nav class="overlay-menu">
						<ul>
							<li>
								<a href="/" class="cursor-pointer">
									Bóka
								</a>
							</li>
							<li>
								<a href="/hvernig-virkar-park-and-fly" class="cursor-pointer">
									Hvernig virkar Park and fly?
								</a>
							</li>
							<li>
								<a href="/algengar-spurningar" class="cursor-pointer">
									Algengar Spurningar
								</a>
							</li>
							<li>
								<a href="/verdskra" class="cursor-pointer">
									Verðskrá
								</a>
							</li>
							<li>
								<a href="/um-okkur" class="cursor-pointer">
									Um Okkur
								</a>
							</li>
							<li>
								<a href="/skilmalar" class="cursor-pointer">
									Skilmálar
								</a>
							</li>
						</ul>
					</nav>
				</div>
			</li>
		</ul>
	</nav>
</template>

<script>
	export default {
		data() {
			return {
				isActive: false
			}
		},
		methods: {
			toggleMenu(){
				this.isActive = !this.isActive
			}
		}
	}
</script>

<style type="text/css">

.button_container {
	position: relative;
	height: 27px;
	width: 35px;
	cursor: pointer;
	z-index: 100;
	transition: opacity .25s ease;
}

.active .top {
	transform: translateY(10px) translateX(0) rotate(45deg);
	background: #fff;
}

.active .middle {
	opacity: 0;
	background: #fff;
}

.active .bottom {
	transform: translateY(-10px) translateX(0) rotate(-45deg);
	background: #fff;
}

.button_container span {
	background: #fff;
	border: none;
	height: 5px;
	width: 100%;
	position: absolute;
	top: 0px;
	left: 0;
	transition:  all .35s ease;
	cursor: pointer;
}

.button_container span:nth-of-type(2) {
	top: 10px;
}

.button_container span:nth-of-type(3) {
	top: 20px;
}

.overlay {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	opacity: 1;
	visibility: hidden;
	transition: opacity .35s, visibility .35s, width .35s;
	z-index: 50;
}

.overlay:before {
	content: '';
	background: #4299e1;
	left: -55%;
	top: 0;
	width: 50%;
	height: 100%;
	position: absolute;
	transition: left .35s ease;
}

.overlay:after {
	content: '';
	background: #4299e1;
	right: -55%;
	top: 0;
	width: 50%;
	height: 100%;
	position: absolute;
	transition: all .35s ease;
}

.open {
	opacity: .9;
	visibility: visible;
	height: 100%;
}

.open:before {
	left: 0;
}

.open:after {
	right: 0;
}

.overlay-menu ul li {
	animation: fadeInRight .5s ease forwards;
	animation-delay: .35s;
}

.overlay-menu ul li:nth-of-type(2) {
	animation-delay: .45s;
}

.overlay-menu ul li:nth-of-type(3) {
	animation-delay: .55s;
}

.overlay-menu ul li:nth-of-type(4) {
	animation-delay: .65s;
}

.overlay-menu {
	position: relative;
	height: 70%;
	top: 50%;
	transform: translateY(-50%);
	font-size: 40px;
	font-weight: 400;
	text-align: center;
	z-index: 100;
}

.overlay-menu ul {
	list-style: none;
	padding: 0;
	margin: 0 auto;
	display: inline-block;
	position: relative;
	height: 100%;
}

.overlay-menu ul li {
	display: block;
	margin-bottom: 50px;
	position: relative;
	opacity: 1;
}

.overlay-menu ul li a {
	display: block;
	position: relative;
	color: #fff;
	text-decoration: none;
	overflow: hidden;
}

.overlay-menu ul li a:hover:after,
.overlay-menu ul li a:focus:after,
.overlay-menu ul li a:active:after {
	width: 100%;
}

.overlay-menu ul li a:after {
	content: '';
	position: absolute;
	bottom: 0;
	left: 50%;
	width: 0%;
	transform: translateX(-50%);
	height: 3px;
	background: #fff;
	transition: .35s;
}

@keyframes fadeInRight {
	0% {
		opacity: 0;
		left: 20%;
	}
	100% {
		opacity: 1;
		left: 0;
	}
}
</style>
