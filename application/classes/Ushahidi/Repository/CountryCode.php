<?php defined('SYSPATH') or die('No direct script access');

/**
 * Ushahidi Config Repository, using Kohana::$config
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Application
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

use Ushahidi\Core\Entity\CountryCode;
use Ushahidi\Core\Entity\CountryCodeRepository;
use Ushahidi\Core\SearchData;
use Ushahidi\Core\Usecase\ReadRepository;
use Ushahidi\Core\Usecase\SearchRepository;

class Ushahidi_Repository_CountryCode extends Ushahidi_Repository implements
	CountryCodeRepository,
    ReadRepository,
    SearchRepository
{
	// Ushahidi_Repository
	protected function getTable()
	{
		return 'country_codes';
	}

	public function getSearchFields() {
		return ['country_code', 'dial_code'];
	}

	public function setSearchConditions(SearchData $search)
    {
        $query = $this->search_query;
        return $query;
    }

    public function getEntity(Array $data = null)
    {
        return new CountryCode($data);
    }
}
