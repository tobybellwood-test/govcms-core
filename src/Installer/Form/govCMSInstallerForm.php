<?php

/**
 * @file
 * govCMS Custom Installer Form.
 */

namespace Drupal\govcms\Installer\Form;

use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Extension\ModuleInstallerInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class govCMSInstallerForm
 *
 * @package Drupal\govcms\Installer\Form
 */
class govCMSInstallerForm extends FormBase {
  /**
   * The module installer.
   *
   * @var \Drupal\Core\Extension\ModuleInstallerInterface
   */
  protected $moduleInstaller;

  /**
   * govCMSInstallerForm constructor.
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
    return "govcms_installer_form";
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#title'] = t('Optional');

    $form['govcms_blog'] = [
      '#type' => 'checkbox',
      '#title' => 'govCMS blog article',
      '#description' => t("Defines blog article content type"),
      '#default_value' => TRUE,
    ];

    $form['govcms_event'] = [
      '#type' => 'checkbox',
      '#title' => 'govCMS event',
      '#description' => t("Defines event content type"),
      '#default_value' => TRUE,
    ];

    $form['govcms_news_and_media'] = [
      '#type' => 'checkbox',
      '#title' => 'govCMS news and media',
      '#description' => t("Defines news and media content type"),
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
    $input = $form_state->getUserInput();
    if (isset($input['govcms_blog'])) {
      $govcms_blog = !empty($input['govcms_blog']);
    }

    if (isset($input['govcms_event'])) {
      $govcms_event = !empty($input['govcms_event']);
    }

      if (isset($input['govcms_news_and_media'])) {
          $govcms_news_and_media = !empty($input['govcms_news_and_media']);
      }

    if ($govcms_blog) {
      $this->moduleInstaller->install(['govcms_content_types_govcms_blog_article']);
    }

    if ($govcms_event) {
      $this->moduleInstaller->install(['govcms_content_types_govcms_event']);
    }

    if ($govcms_news_and_media) {
      $this->moduleInstaller->install(['govcms_content_types_govcms_news_and_media']);
    }
  }
}
