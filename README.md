# Ask Question Module

## Overview

The Ask Question Module is a feature-rich extension for enhancing the product view page on your website. It introduces an "Ask Question" button that allows users to easily inquire about a product. Additionally, the module facilitates communication by sending an email to the company, ensuring seamless interaction with potential customers.

### Key Features

Ask Question Button: Adds a prominent "Ask Question" button on the product view page.

User-Friendly Interface: Provides a simple and intuitive interface for users to submit their inquiries.

Email Integration: Sends email notifications to the company with the user's question, enhancing communication.

## Installation

1. Clone this repository into the app/code directory of your Magento 2 installation: <br/>
`git clone https://github.com/tomk1v/product-question-module.git`

2. Run the following commands from the Magento root directory: <br/>
`bin/magento module:enable Internship_CategoryImagesExport` <br/>
`bin/magento setup:upgrade` <br/>
`bin/magento setup:di:compile` <br/>

3. Flush the cache: <br/>
`bin/magento cache:flush`

## Usage

Navigate to Product Question configuration in the Magento Admin Panel and fill in the sender name and email in the appropriate places.
![2024-03-01_10-20](https://github.com/tomk1v/product-question-module/assets/91790934/2dd1371a-4efd-4271-9839-661334c68055)

Visit the product view page and click the 'Ask Question' button.
![2024-03-01_12-14](https://github.com/tomk1v/product-question-module/assets/91790934/61966c51-fe2a-41fe-b29c-72b5af20b950)

Check mail service.
![2024-03-01_13-30](https://github.com/tomk1v/product-question-module/assets/91790934/c035ce66-5bb4-4274-bb98-19ee6420e292)

## Compatibility

This module is designed to work seamlessly with:

Magento 2.4.6 <br/>
PHP 8.2 <br/>
©tomk1v
