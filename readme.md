# Random-Images

通过随机发送 `url.csv` 文件中给出的图床链接来实现一个随机图片 API  

## 使用说明

### env

在 vercel 中设置环境变量 `BASE_URL`，如 `random-zpic.vercel.app`，纯域名。

### url.csv

`url.csv` 文件中的每一行都是一个图床链接。

例如原图片直链是 `https://random-zpic.vercel.app/**/xxx.png`，

只需粘贴 `/**/xxx.png` 就可以了。

部署前可以用test.php测试一下（有php环境的话）

## 演示

- <https://random-zpic.vercel.app/images>

> 演示图片来自<https://pic.marxchou.com>

## php 部署到 Vercel

fork 后，修改自己仓库的 `url.csv`，然后在 Vercel 平台上导入自己的项目

[![Deploy to Vercel](https://vercel.com/button)](https://vercel.com/import/git?s=https%3A%2F%2Fgithub.com%2FSmart-Chou%2FRandom-Images)

第一次部署可能不成功，将nodejs版本改成18，再次部署就行(vercel 目前默认20，有点问题)。

## 项目参考

- <https://github.com/vercel-community/php>
- <https://github.com/galnetwen/Random-Image>
- <https://github.com/YieldRay/Random-Picture/>
