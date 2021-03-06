<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2019
 * @package Controller
 * @subpackage Common
 */


namespace Aimeos\Controller\Common\Common\Import;


/**
 * Shared class for XML importers
 *
 * @package Controller
 * @subpackage Common
 */
trait Traits
{
	private $typeMap = [];


	abstract protected function getContext();


	/**
	 * Registers a used type which is going to be saved if it doesn't exist yet
	 *
	 * @param string $path Manager path, e.g. "product/lists/type"
	 * @param string $domain Domain name the type belongs to, e.g. "attribute"
	 * @param string $code Type code
	 * @param self Same object for method chaining
	 */
	protected function addType( $path, $domain, $code )
	{
		$this->typeMap[$path][$domain][$code] = $code;
		return $this;
	}


	/**
	 * Stores all types for which no type items exist yet
	 *
	 * @param self Same object for method chaining
	 */
	protected function saveTypes()
	{
		foreach( $this->typeMap as $path => $list )
		{
			$manager = \Aimeos\MShop::create( $this->getContext(), $path );
			$prefix = str_replace( '/', '.', $path );

			foreach( $list as $domain => $codes )
			{
				$manager->begin();

				try
				{
					$search = $manager->createSearch()->setSlice( 0, 10000 );
					$expr = [
						$search->compare( '==', $prefix . '.domain', $domain ),
						$search->compare( '==', $prefix . '.code', $codes )
					];
					$search->setConditions( $search->combine( '&&', $expr ) );

					$types = $items = [];

					foreach( $manager->searchItems( $search ) as $item ) {
						$types[] = $item->getCode();
					}

					foreach( array_diff( $codes, $types ) as $code ) {
						$items[] = $manager->createItem()->setDomain( $domain )->setCode( $code )->setLabel( $code );
					}

					$manager->saveItems( $items, false );
					$manager->commit();
				}
				catch( \Exception $e )
				{
					$manager->rollback();
					$this->getContext()->getLogger()->log( 'Error saving types: ' . $e->getMessage() . PHP_EOL . $e->getTraceAsString() );
				}
			}
		}
	}
}
