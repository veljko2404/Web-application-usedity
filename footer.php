        <div class="footer">
			<div class="footer-links">
				<div class="links-row">
					<h4>| Quick links</h4>
					<ul class="">
						<li><a href="https://www.usedity.com/about/"><i class="fa fa-angle-double-right"></i> About</a></li>
						<li><a href="https://www.usedity.com/contact/"><i class="fa fa-angle-double-right"></i> Contact</a></li>
						<li><a href="https://www.usedity.com/how_it_works/"><i class="fa fa-angle-double-right"></i> How it works</a></li>
						<li><a href="https://www.usedity.com/privacy_policy/"><i class="fa fa-angle-double-right"></i> Privacy Policy</a></li>
					</ul>
				</div>
				<div class="links-row">
					<h4>| Profile links</h4>
					<ul class="">
					    <?php if(isset($_SESSION['user'])) { ?>
					    <li><a href="https://www.usedity.com/profile/logout.php"><i class="fa fa-angle-double-right"></i> Logout</a></li>
						<li><a href="https://www.usedity.com/profile/edit-profile.php"><i class="fa fa-angle-double-right"></i> Edit</a></li>
						<li><a href="https://www.usedity.com/profile/messages.php"><i class="fa fa-angle-double-right"></i> Messages</a></li>
						<li><a href="https://www.usedity.com/sell_car/"><i class="fa fa-angle-double-right"></i> Sell Car</a></li>
						<?php } else { ?>
						<li><a href="https://www.usedity.com/login/"><i class="fa fa-angle-double-right"></i> Login</a></li>
						<li><a href="https://www.usedity.com/register/"><i class="fa fa-angle-double-right"></i> Register</a></li>
						<br><br>
						<?php } ?>
					</ul>
					<br><br>
				</div>
				<div class="footer-text">
					<p class="h6">© <?php echo date("Y") ?> Usedity Inc. All Rights Reserved</p>
				    <br>
				</div>
			</div>
			<div class="footer-links">
				<div class="social">
					<ul>
						<li><a href="https://www.facebook.com/Usedity-212279506125579/"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://www.instagram.com/usedity_inc/"><i class="fa fa-instagram"></i></a></li>
					</ul>
					<br>
				</div>
			</div>
		</div>