# Android Market API (PHP)

[![DOI](https://zenodo.org/badge/DOI/10.5281/zenodo.14769247.svg)](https://doi.org/10.5281/zenodo.14769247)

Un-official PHP client for the (legacy) Android Market / Google Play Store — first released in 2012 and still used for archival research, market-data collection, and automation pipelines.

---

## Table of Contents
1. [Overview](#overview)
2. [Connection Settings & Troubleshooting](#connection-settings--troubleshooting)
3. [Examples](#examples)
4. [How to Cite](#how-to-cite)
5. [Issues & Support](#issues--support)
6. [Credits](#credits)
7. [License](#license)

---

## Overview
This library exposes most of the original Android Market RPCs (login,
app details, search, downloads) to PHP. **Google has never released an
official Play Store API**, so this code relies on reverse-engineered
protobuf calls that still work for many use cases.

---

## Connection Settings & Troubleshooting
Configure **`examples/local.php`** with:

| Setting | Notes |
|---------|-------|
| **Google Account (`USERNAME`, `PASSWORD`)** | Use an _App Password_ from a Google account with 2-step verification to reduce CAPTCHA blocks. |
| **Android Device ID** | Retrieve via the free app <https://play.google.com/store/apps/details?id=com.evozi.deviceid>. |
| **Rate-Limiting** | The Play backend will 403/400 if you spam requests. Insert `sleep()` between calls. |
| **CAPTCHA Unlock** | Log in to the same account in a browser and visit <https://accounts.google.com/DisplayUnlockCaptcha>. |

---

## Examples
See code for examples

---

## How to Cite
If this software was helpful in your research, please cite **version v1**:

```bibtex
@software{Koc_2025_android_market_api_php,
  author       = {Vincent Koc},
  title        = {{Android Market API (PHP)}},
  version      = {v1},
  year         = {2025},
  doi          = {10.5281/zenodo.14769247},
  url          = {https://doi.org/10.5281/zenodo.14769247}
}
