[![REMIND](https://img.shields.io/badge/REMIND-black.svg)](https://www.remind.de/) 
[![HEADLESS](https://img.shields.io/badge/HEADLESS-blue.svg)](https://github.com/remindgmbh/headless) 
[![TYPO3 12](https://img.shields.io/badge/TYPO3-orange.svg)](https://get.typo3.org/) 

# REMIND - Downloads Extension

This TYPO3 extension provides functionality for managing downloadable content.

## Features

- Manage downloadable content via TYPO3 backend.
- Group and organize downloads for better accessibility.
- JSON-based API responses for frontend integration.

## Dependencies
- `remind/extbase`
- `remind/headless`

## Installation

Add the extension to your project using Composer:

```bash
composer require remind/downloads
```

## Composer Scripts

The extension includes Composer scripts for code quality checks:

- **Run PHP CodeSniffer**:
  ```bash
  composer phpcs
  ```

- **Run PHP Code Beautifier**:
  ```bash
  composer phpcbf
  ```