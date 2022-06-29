<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'CreativeMail\\Blocks\\LoadBlock' => $baseDir . '/src/blocks/LoadBlock.php',
    'CreativeMail\\Clients\\CreativeMailClient' => $baseDir . '/src/Clients/CreativeMailClient.php',
    'CreativeMail\\Constants\\EnvironmentNames' => $baseDir . '/src/Constants/EnvironmentNames.php',
    'CreativeMail\\CreativeMail' => $baseDir . '/src/CreativeMail.php',
    'CreativeMail\\Exceptions\\CreativeMailException' => $baseDir . '/src/Exceptions/CreativeMailException.php',
    'CreativeMail\\Helpers\\EncryptionHelper' => $baseDir . '/src/Helpers/EncryptionHelper.php',
    'CreativeMail\\Helpers\\EnvironmentHelper' => $baseDir . '/src/Helpers/EnvironmentHelper.php',
    'CreativeMail\\Helpers\\GuidHelper' => $baseDir . '/src/Helpers/GuidHelper.php',
    'CreativeMail\\Helpers\\OptionsHelper' => $baseDir . '/src/Helpers/OptionsHelper.php',
    'CreativeMail\\Helpers\\SsoHelper' => $baseDir . '/src/Helpers/SsoHelper.php',
    'CreativeMail\\Helpers\\ValidationHelper' => $baseDir . '/src/Helpers/ValidationHelper.php',
    'CreativeMail\\Integrations\\Integration' => $baseDir . '/src/Integrations/Integration.php',
    'CreativeMail\\Managers\\AdminManager' => $baseDir . '/src/Managers/AdminManager.php',
    'CreativeMail\\Managers\\ApiManager' => $baseDir . '/src/Managers/ApiManager.php',
    'CreativeMail\\Managers\\CheckoutManager' => $baseDir . '/src/Managers/CheckoutManager.php',
    'CreativeMail\\Managers\\DatabaseManager' => $baseDir . '/src/Managers/DatabaseManager.php',
    'CreativeMail\\Managers\\EmailManager' => $baseDir . '/src/Managers/EmailManager.php',
    'CreativeMail\\Managers\\FormManager' => $baseDir . '/src/Managers/FormManager.php',
    'CreativeMail\\Managers\\InstanceManager' => $baseDir . '/src/Managers/InstanceManager.php',
    'CreativeMail\\Managers\\IntegrationManager' => $baseDir . '/src/Managers/IntegrationManager.php',
    'CreativeMail\\Managers\\RaygunManager' => $baseDir . '/src/Managers/RaygunManager.php',
    'CreativeMail\\Models\\ApiSchema' => $baseDir . '/src/Models/ApiSchema.php',
    'CreativeMail\\Models\\Campaign' => $baseDir . '/src/Models/Campaign.php',
    'CreativeMail\\Models\\CartData' => $baseDir . '/src/Models/CartData.php',
    'CreativeMail\\Models\\Checkout' => $baseDir . '/src/Models/Checkout.php',
    'CreativeMail\\Models\\CheckoutSave' => $baseDir . '/src/Models/CheckoutSave.php',
    'CreativeMail\\Models\\CustomerNewAccount' => $baseDir . '/src/Models/CustomerNewAccount.php',
    'CreativeMail\\Models\\CustomerNote' => $baseDir . '/src/Models/CustomerNote.php',
    'CreativeMail\\Models\\CustomerResetPassword' => $baseDir . '/src/Models/CustomerResetPassword.php',
    'CreativeMail\\Models\\EmailNotification' => $baseDir . '/src/Models/EmailNotification.php',
    'CreativeMail\\Models\\HashSchema' => $baseDir . '/src/Models/HashSchema.php',
    'CreativeMail\\Models\\OptionsSchema' => $baseDir . '/src/Models/OptionsSchema.php',
    'CreativeMail\\Models\\Order' => $baseDir . '/src/Models/Order.php',
    'CreativeMail\\Models\\OrderBilling' => $baseDir . '/src/Models/OrderBilling.php',
    'CreativeMail\\Models\\RequestItem' => $baseDir . '/src/Models/RequestItem.php',
    'CreativeMail\\Models\\Response' => $baseDir . '/src/Models/Response.php',
    'CreativeMail\\Models\\TriggerExecution' => $baseDir . '/src/Models/TriggerExecution.php',
    'CreativeMail\\Models\\User' => $baseDir . '/src/Models/User.php',
    'CreativeMail\\Modules\\Api\\Models\\ApiRequestItem' => $baseDir . '/src/Modules/Api/Models/ApiRequestItem.php',
    'CreativeMail\\Modules\\Api\\Processes\\ApiBackgroundProcess' => $baseDir . '/src/Modules/Api/Processes/ApiBackgroundProcess.php',
    'CreativeMail\\Modules\\Blog\\Models\\BlogAttachment' => $baseDir . '/src/Modules/Blog/Models/BlogAttachment.php',
    'CreativeMail\\Modules\\Blog\\Models\\BlogInformation' => $baseDir . '/src/Modules/Blog/Models/BlogInformation.php',
    'CreativeMail\\Modules\\Blog\\Models\\BlogPost' => $baseDir . '/src/Modules/Blog/Models/BlogPost.php',
    'CreativeMail\\Modules\\Contacts\\Exceptions\\InvalidContactSyncBackgroundRequestException' => $baseDir . '/src/Modules/Contacts/Exceptions/InvalidContactSyncBackgroundRequestException.php',
    'CreativeMail\\Modules\\Contacts\\Exceptions\\InvalidHandlerContactSyncRequestException' => $baseDir . '/src/Modules/Contacts/Exceptions/InvalidHandlerContactSyncRequestException.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\BaseContactFormPluginHandler' => $baseDir . '/src/Modules/Contacts/Handlers/BaseContactFormPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\BlueHostBuilderPluginHandler' => $baseDir . '/src/Modules/Contacts/Handlers/BlueHostBuilderPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\CalderaPluginHandler' => $baseDir . '/src/Modules/Contacts/Handlers/CalderaPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\ContactFormSevenPluginHandler' => $baseDir . '/src/Modules/Contacts/Handlers/ContactFormSevenPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\CreativeMailPluginHandler' => $baseDir . '/src/Modules/Contacts/Handlers/CreativeMailPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\ElementorPluginHandler' => $baseDir . '/src/Modules/Contacts/Handlers/ElementorPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\FormidablePluginHandler' => $baseDir . '/src/Modules/Contacts/Handlers/FormidablePluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\GravityFormsPluginHandler' => $baseDir . '/src/Modules/Contacts/Handlers/GravityFormsPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\JetpackPluginHandler' => $baseDir . '/src/Modules/Contacts/Handlers/JetpackPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\NewsLetterContactFormPluginHandler' => $baseDir . '/src/Modules/Contacts/Handlers/NewsLetterContactFormPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\NinjaFormsPluginHandler' => $baseDir . '/src/Modules/Contacts/Handlers/NinjaFormsPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\WooCommercePluginHandler' => $baseDir . '/src/Modules/Contacts/Handlers/WooCommercePluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\WpFormsPluginHandler' => $baseDir . '/src/Modules/Contacts/Handlers/WpFormsPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Managers\\ContactsSyncManager' => $baseDir . '/src/Modules/Contacts/Managers/ContactsSyncManager.php',
    'CreativeMail\\Modules\\Contacts\\Models\\ContactAddressModel' => $baseDir . '/src/Modules/Contacts/Models/ContactAddressModel.php',
    'CreativeMail\\Modules\\Contacts\\Models\\ContactFormSevenSubmission' => $baseDir . '/src/Modules/Contacts/Models/ContactFormSevenSubmission.php',
    'CreativeMail\\Modules\\Contacts\\Models\\ContactModel' => $baseDir . '/src/Modules/Contacts/Models/ContactModel.php',
    'CreativeMail\\Modules\\Contacts\\Models\\OptActionBy' => $baseDir . '/src/Modules/Contacts/Models/OptActionBy.php',
    'CreativeMail\\Modules\\Contacts\\Processors\\ContactsSyncBackgroundProcessor' => $baseDir . '/src/Modules/Contacts/Processors/ContactsSyncBackgroundProcessor.php',
    'CreativeMail\\Modules\\Contacts\\Services\\ContactsSyncService' => $baseDir . '/src/Modules/Contacts/Services/ContactsSyncService.php',
    'CreativeMail\\Modules\\DashboardWidgetModule' => $baseDir . '/src/Modules/DashboardWidgetModule.php',
    'CreativeMail\\Modules\\FeedbackNoticeModule' => $baseDir . '/src/Modules/FeedbackNoticeModule.php',
    'CreativeMail\\Modules\\WooCommerce\\Emails\\AbandonedCartEmail' => $baseDir . '/src/Modules/WooCommerce/Emails/AbandonedCartEmail.php',
    'CreativeMail\\Modules\\WooCommerce\\Models\\WCInformationModel' => $baseDir . '/src/Modules/WooCommerce/Models/WCInformationModel.php',
    'CreativeMail\\Modules\\WooCommerce\\Models\\WCProductModel' => $baseDir . '/src/Modules/WooCommerce/Models/WCProductModel.php',
    'CreativeMail\\Modules\\WooCommerce\\Models\\WCStoreInformation' => $baseDir . '/src/Modules/WooCommerce/Models/WCStoreInformation.php',
    'Defuse\\Crypto\\Core' => $vendorDir . '/defuse/php-encryption/src/Core.php',
    'Defuse\\Crypto\\Crypto' => $vendorDir . '/defuse/php-encryption/src/Crypto.php',
    'Defuse\\Crypto\\DerivedKeys' => $vendorDir . '/defuse/php-encryption/src/DerivedKeys.php',
    'Defuse\\Crypto\\Encoding' => $vendorDir . '/defuse/php-encryption/src/Encoding.php',
    'Defuse\\Crypto\\Exception\\BadFormatException' => $vendorDir . '/defuse/php-encryption/src/Exception/BadFormatException.php',
    'Defuse\\Crypto\\Exception\\CryptoException' => $vendorDir . '/defuse/php-encryption/src/Exception/CryptoException.php',
    'Defuse\\Crypto\\Exception\\EnvironmentIsBrokenException' => $vendorDir . '/defuse/php-encryption/src/Exception/EnvironmentIsBrokenException.php',
    'Defuse\\Crypto\\Exception\\IOException' => $vendorDir . '/defuse/php-encryption/src/Exception/IOException.php',
    'Defuse\\Crypto\\Exception\\WrongKeyOrModifiedCiphertextException' => $vendorDir . '/defuse/php-encryption/src/Exception/WrongKeyOrModifiedCiphertextException.php',
    'Defuse\\Crypto\\File' => $vendorDir . '/defuse/php-encryption/src/File.php',
    'Defuse\\Crypto\\Key' => $vendorDir . '/defuse/php-encryption/src/Key.php',
    'Defuse\\Crypto\\KeyOrPassword' => $vendorDir . '/defuse/php-encryption/src/KeyOrPassword.php',
    'Defuse\\Crypto\\KeyProtectedByPassword' => $vendorDir . '/defuse/php-encryption/src/KeyProtectedByPassword.php',
    'Defuse\\Crypto\\RuntimeTests' => $vendorDir . '/defuse/php-encryption/src/RuntimeTests.php',
    'Firebase\\JWT\\BeforeValidException' => $vendorDir . '/firebase/php-jwt/src/BeforeValidException.php',
    'Firebase\\JWT\\ExpiredException' => $vendorDir . '/firebase/php-jwt/src/ExpiredException.php',
    'Firebase\\JWT\\JWK' => $vendorDir . '/firebase/php-jwt/src/JWK.php',
    'Firebase\\JWT\\JWT' => $vendorDir . '/firebase/php-jwt/src/JWT.php',
    'Firebase\\JWT\\Key' => $vendorDir . '/firebase/php-jwt/src/Key.php',
    'Firebase\\JWT\\SignatureInvalidException' => $vendorDir . '/firebase/php-jwt/src/SignatureInvalidException.php',
    'Raygun4php\\Raygun4PhpException' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/Raygun4PhpException.php',
    'Raygun4php\\RaygunClient' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/RaygunClient.php',
    'Raygun4php\\RaygunClientMessage' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/RaygunClientMessage.php',
    'Raygun4php\\RaygunEnvironmentMessage' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/RaygunEnvironmentMessage.php',
    'Raygun4php\\RaygunExceptionMessage' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/RaygunExceptionMessage.php',
    'Raygun4php\\RaygunExceptionTraceLineMessage' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/RaygunExceptionTraceLineMessage.php',
    'Raygun4php\\RaygunIdentifier' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/RaygunIdentifier.php',
    'Raygun4php\\RaygunMessage' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/RaygunMessage.php',
    'Raygun4php\\RaygunMessageDetails' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/RaygunMessageDetails.php',
    'Raygun4php\\RaygunRequestMessage' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/RaygunRequestMessage.php',
    'WP_Async_Request' => $vendorDir . '/a5hleyrich/wp-background-processing/classes/wp-async-request.php',
    'WP_Background_Process' => $vendorDir . '/a5hleyrich/wp-background-processing/classes/wp-background-process.php',
);