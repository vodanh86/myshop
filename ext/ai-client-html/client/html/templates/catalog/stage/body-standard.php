<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2018
 */

$enc = $this->encoder();
$catPath = (array) $this->get( 'stageCatPath', [] );

$classes = '';
foreach( $catPath as $cat )
{
	$config = $cat->getConfig();
	if( isset( $config['css-class'] ) ) {
		$classes .= ' ' . $config['css-class'];
	}
}

$mediaItems = [];
foreach( array_reverse( $catPath ) as $catItem )
{
	if( ( $mediaItems = $catItem->getRefItems( 'media', 'stage', 'default' ) ) !== [] ) {
		break;
	}
}

$treeTarget = $this->config( 'client/html/catalog/tree/url/target' );
$treeController = $this->config( 'client/html/catalog/tree/url/controller', 'catalog' );
$treeAction = $this->config( 'client/html/catalog/tree/url/action', 'tree' );
$treeConfig = $this->config( 'client/html/catalog/tree/url/config', [] );

$listTarget = $this->config( 'client/html/catalog/lists/url/target' );
$listController = $this->config( 'client/html/catalog/lists/url/controller', 'catalog' );
$listAction = $this->config( 'client/html/catalog/lists/url/action', 'list' );
$listConfig = $this->config( 'client/html/catalog/lists/url/config', [] );

$optTarget = $this->config( 'client/jsonapi/url/target' );
$optCntl = $this->config( 'client/jsonapi/url/controller', 'jsonapi' );
$optAction = $this->config( 'client/jsonapi/url/action', 'options' );
$optConfig = $this->config( 'client/jsonapi/url/config', [] );

$params = $this->get( 'stageParams', [] );


?>
<section class="aimeos catalog-stage<?= $enc->attr( $classes ); ?>" data-jsonurl="<?= $enc->attr( $this->url( $optTarget, $optCntl, $optAction, [], [], $optConfig ) ); ?>">

	<?php if( isset( $this->stageErrorList ) ) : ?>
		<ul class="error-list">
			<?php foreach( (array) $this->stageErrorList as $errmsg ) : ?>
				<li class="error-item"><?= $enc->html( $errmsg ); ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	<div class="catalog-stage-breadcrumb">
		<nav class="breadcrumb">
			<ol>

				<?php if( isset( $this->stageCatPath ) ) : ?>
					<?php foreach( (array) $this->stageCatPath as $cat ) : $params['f_name'] = $cat->getName( 'url' ); $params['f_catid'] = $cat->getId(); ?>
						<li>
							<a href="<?= $enc->attr( $this->url( $treeTarget, $treeController, $treeAction, $params, [], $treeConfig ) ); ?>">
								<?= $enc->html( $cat->getName() ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				<?php else : ?>
					<li>
						<a href="<?= $enc->attr( $this->url( $listTarget, $listController, $listAction, $params, [], $listConfig ) ); ?>">
						</a>
					</li>
				<?php endif; ?>

			</ol>
		</nav>
	</div>


	<?= $this->block()->get( 'catalog/stage/navigator' ); ?>

</section>
