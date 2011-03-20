	</div>
	<div id="sidebar">
		<div class="sidebar_item">
			<div class="sidebar_item_title">
				Highnimal
			</div>
			<div class="sidebar_item_content">
				    Highnimal est une place de marché permettant au propriétaire d’animaux de pedigree de trouver ou mettre à disposition un compagnon pure race ou le reproducteur idéal pour une descendance de qualité.
			</div>
		</div>
		<div class="sidebar_item">
			<div class="sidebar_item_title">
				Qualité, Simplicité, Ethique
			</div>
			<div class="sidebar_item_content">
				    Dans un souci de qualité, la charte éthique de Highnimal est élaborée afin de protéger et reconnaître les animaux de pedigree.
Dans le cadre de cette transparence, Highnimal met à disposition de tous ses utilisateurs sur son moteur de recherche des fiches détaillées de chaque animal enregistré sur le site.
			</div>
		</div>
	</div>
	<div class="clear"> </div>
	<div id="footer" role="contentinfo">
		<div id="footerinfos">
			<div id="footerleft" class="footercolumn">
				<div class="footer_item">Le Blog</div>
				<div class="footer_item">Conseils Animaliers</div>
			</div>
			<div id="footercenter" class="footercolumn">
				<div class="footer_item">Partenaires</div>
				<div class="footer_item">Contact</div>
				<div class="footer_item">Aide</div>
			</div>
			<div id="footerright" class="footercolumn">
				<div class="footer_item">Conditions d'utilisations</div>
				<div class="footer_item">Informations Légales</div>
				<div class="footer_item"><?=anchor('accueil/charteethique', 'Charte Ethique', array('title' => 'Charte Ethique')); ?></div>
			</div>
			<div class="clear"> </div>
		</div>
		<div id="highnimalright">
			<div id="copyright">Copyright © highnimal.com</div>
			<div id="designby">Design by <?=anchor('http://pixanimal.com', 'Pixanimal', array('title' => 'Pixanimal')); ?> -- <?=anchor('http://c.line-design.fr', 'C.line', array('title' => 'C.line')); ?></div>
			<time datetime="2011-03-20">2011<?php if(date("Y") != "2011") { echo " - ".date("Y");} ?></time>
		</div>
	</div>
</body>
</html>