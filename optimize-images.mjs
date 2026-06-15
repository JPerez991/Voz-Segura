import sharp from 'sharp';
import { readFileSync } from 'fs';

const images = [
  { src: 'public/img/vista-login/mujerPuerpe.jpg', dest: 'public/img/vista-login/mujerPuerpe.webp', width: 1920 },
  { src: 'public/img/curly-woman-holding-her-hair-studio.jpg', dest: 'public/img/curly-woman-holding-her-hair-studio.webp', width: 1920 },
  { src: 'public/assets/img/01.jpg', dest: 'public/assets/img/01.webp', width: 1200 },
  { src: 'public/assets/img/06.jpg', dest: 'public/assets/img/06.webp', width: 1200 },
  { src: 'public/assets/img/09.png', dest: 'public/assets/img/09.webp', width: 1200 },
  { src: 'public/assets/img/hero-bg.jpg', dest: 'public/assets/img/hero-bg.webp', width: 1920 },
  { src: 'public/assets/img/section-1.jpg', dest: 'public/assets/img/section-1.webp', width: 800 },
  { src: 'public/assets/img/section-2.jpg', dest: 'public/assets/img/section-2.webp', width: 800 },
  { src: 'public/assets/img/section-3.jpg', dest: 'public/assets/img/section-3.webp', width: 800 },
  { src: 'public/assets/img/curly-woman-holding-her-hair-studio.jpg', dest: 'public/assets/img/curly-woman-holding-her-hair-studio.webp', width: 1920 },
];

async function main() {
  for (const img of images) {
    const file = readFileSync(img.src);
    const info = await sharp(file)
      .resize({ width: img.width, withoutEnlargement: true })
      .webp({ quality: 80 })
      .toFile(img.dest);
    const saved = ((file.length - info.size) / file.length * 100).toFixed(1);
    console.log(`${img.src.split('/').pop()} → ${img.dest.split('/').pop()}: ${(info.size / 1024).toFixed(0)} KB (${saved}% smaller)`);
  }
}

main().catch(console.error);
