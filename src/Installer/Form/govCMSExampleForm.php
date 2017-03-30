<?php

/**
 * @file
 * govCMS Examples Installer Form.
 */

namespace Drupal\govcms\Installer\Form;

use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Extension\ModuleInstallerInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class govCMSExampleForm
 *
 * @package Drupal\govcms\Installer\Form
 */
class govCMSExampleForm extends FormBase {
  /**
   * The module installer.
   *
   * @var \Drupal\Core\Extension\ModuleInstallerInterface
   */
  protected $moduleInstaller;

  /**
   * govCMSExampleForm constructor.
   *
   * @param ModuleInstallerInterface $module_installer
   */
  public function __construct(ModuleInstallerInterface $module_installer) {
    $this->moduleInstaller = $module_installer;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('module_installer')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return "govcms_example_form";
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#title'] = t('Optional');

    $form['govcms_demo'] = [
      '#type' => 'checkbox',
      '#title' => 'govCMS content examples',
      '#description' => t("Creates demo content to help you test out GovCMS. If you want to remove it later, simply disable the <em>govCMS Demo</em> module."),
      '#default_value' => TRUE,
    ];

    $form['warning'] = [
      '#markup' => "<p><strong>Warning:</strong> Don't install the optional modules if you're upgrading from Drupal 7 - you need to start from a blank site.</p>",
    ];

    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save and continue'),
      '#weight' => 99,
      '#button_type' => 'primary',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Placeholder.
  }
}
