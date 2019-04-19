<script type="text/javascript">
function PrintElem() {
	var divToPrint=document.getElementById("surveyResult");
	newWin= window.open("");
	newWin.document.write(divToPrint.outerHTML);
	newWin.print();
	newWin.close();
}
</script>

<div style="width:100%;text-align:right"> <img style="cursor: pointer;" src="https://img.icons8.com/ultraviolet/40/000000/send-to-printer.png" onclick="PrintElem()"></div>

<?php
	// if($_REQUEST) {
	// 	echo "<pre>";
	// 	print_r($_REQUEST);
	// 	echo "</pre>";
	// }
?>

<div id="surveyResult">
	<h1 class="HeadingColor">Excellent! This is the Exact Content You Need Right Now.</h1>
	<h4 class="HeadingColor">WELCOME</h4>
	<p style="margin-bottom: 0">Thank you for taking our survey, please have a look at the links below and if you have any further questions please contact us <a class="HeadingColor" href="<?php echo site_url() ?>">here</a>.
	</p>

	<?php if( $_GET['describe'] ) : ?>
		<div id="solo">
			<?php
				$firstTitle = getTitle($_GET['describe']);
				echo do_shortcode("[recommended_text id=".$_GET['describe']." description=1 blog=0 shop=0 report=0 title='".$firstTitle."']")
			?>
		</div>
	<?php endif; ?>

	<?php if( $_GET['describe'] ) : ?>
		<div id="description">
			<?php
				$descriptionTitle = 'Recommended Content for '.getTitle($_GET['describe']);
				echo do_shortcode("[recommended_text id=".$_GET['describe']." description=0 blog=1 shop=1 report=1 title='".$descriptionTitle."']")
			?>
		</div>
	<?php endif; ?>

	<?php if( $_GET['need'] ) : ?>
		<div id="need">
			<?php
				$needTitle = 'Recommended Content for '.getTitle($_GET['need']);
				echo do_shortcode("[recommended_text id=".$_GET['need']." description=0 blog=1 shop=1 report=1 title='".$needTitle."']")
			?>
		</div>
	<?php endif; ?>

	<?php if( $_GET['category'] ) : ?>
		<div id="category">
			<?php
				$blogTitle = 'Recommended Content for '.getTitle($_GET['category']);
				echo do_shortcode("[recommended_text id=".$_GET['category']." description=0 blog=1 shop=1 report=1 title='".$blogTitle."']")
			?>
		</div>
	<?php endif; ?>

	<div style="clear: both;padding-top: 30px;">
		<p>Thanks once again for filling in this questionnaire, we hope you got a lot of value out of it.</p>
		<p>You will see we have two books to give away in our free membership,
			<a class="HeadingColor" href="https://outsourcethat.today/product/online-outsourcing/" target="_blank">Online Outsourcing - A Resource of Growth</a>
			<a class="HeadingColor" href="https://outsourcethat.today/product/freelance-marketplace/" target="_blank">Anatomy of the Online Freelance Marketplace</a>
		</p>
		<p>If you have not joined already, please do so now at the following <a class="HeadingColor" href="https://outsourcethat.today/free-registration/" target="_blank">link</a>. See you on the inside with our unannounced bonuses.</p>
		<p>Also, check out some of our bundles at <a class="HeadingColor" href="https://outsourcethat.today/bundles" target="_blank">https://outsourcethat.today/bundles</a></p>
	</div>
</div>
