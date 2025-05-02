<?php

namespace Monee\PaygateMonee;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;

class Setup extends AbstractSetup
{
	use StepRunnerInstallTrait;
	use StepRunnerUpgradeTrait;
	use StepRunnerUninstallTrait;

	private static $baseClass = "Monee";

	public function installStep1(): void
	{
		$db = $this->db();

		$db->insert('xf_payment_provider', [
			'provider_id'    => "mn" . self::$baseClass,
			'provider_class' => "Monee\\Paygate" . self::$baseClass . ":" . self::$baseClass,
			'addon_id'       => "Monee/Paygate" . self::$baseClass
		]);
	}

	public function uninstallStep1(): void
	{
		$providerId = "mn" . self::$baseClass;

		$db = $this->db();

		$db->delete('xf_payment_profile', "provider_id = '$providerId'");
		$db->delete('xf_payment_provider', "provider_id = '$providerId'");
	}
}