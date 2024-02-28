<?php
/**
 * Product Question
 * Controller takes data from ajax request.
 *
 * @category Internship
 * @package Internship\ProductQuestion
 * @author Andrii Tomkiv <tomkivandrii18@gmail.com>
 * @copyright 2024 Tomkiv
 */

namespace Internship\ProductQuestion\Controller\Email;

class Question implements \Magento\Framework\App\ActionInterface
{
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \Magento\Framework\Escaper $escaper
     * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
     * @param \Magento\Framework\Controller\ResultFactory $resultFactory
     * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\App\RequestInterface $request
     */
    public function __construct(
        protected \Magento\Framework\App\Action\Context $context,
        protected \Magento\Framework\Message\ManagerInterface $messageManager,
        protected \Magento\Framework\Escaper $escaper,
        protected \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        protected \Magento\Framework\Controller\ResultFactory $resultFactory,
        protected \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        protected \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        protected \Magento\Framework\App\RequestInterface $request
    ){
    }

    /**
     * Execute controller action.
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $requestParams = $this->request->getParam('question');
        if ($requestParams) {
            $senderName = $this->scopeConfig->getValue(
                'trans_email/product_question/name',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            );
            $senderEmail = $this->scopeConfig->getValue(
                'trans_email/product_question/email',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            );

            $receiver = $senderEmail;
            $sender = [
                'name' => $senderName,
                'email' => $senderEmail,
            ];

            try {
                $transport = $this->transportBuilder->setTemplateIdentifier('email_product_question')
                    ->setTemplateOptions([
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID
                    ])
                    ->setTemplateVars([
                        'name' => $this->request->getParam('name'),
                        'email' => $this->request->getParam('email'),
                        'question' => $this->request->getParam('question'),
                        'product_sku' => $this->request->getParam('product_sku')
                    ])
                    ->setFromByScope($sender)
                    ->addTo($receiver)
                    ->setReplyTo($receiver)
                    ->getTransport();
                $transport->sendMessage();

                $this->messageManager->addSuccessMessage(__('We have received your message'));
                $result = ['success' => true, 'message' => 'Email sent successfully'];
            } catch (\Exception $exception) {
                $this->messageManager->addErrorMessage(__('Something went wrong'));
                $result = ['success' => false, 'message' => $exception->getMessage()];
            }
        } else {
            $this->messageManager->addErrorMessage(__('Invalid form key'));
            $result = ['success' => false, 'message' => 'Invalid form key'];
        }

        $resultJson = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);
        $resultJson->setData($result);
        return $resultJson;
    }
}
