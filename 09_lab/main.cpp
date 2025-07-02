#include <iostream>
#include "src/Image.h"
#include "src/ImageService.h"
#include "src/Drawer.h"

int main() {
    {
        Image img = ImageService::LoadImage(
                " CCCC             \n"
                "CC  CC   ##    ## \n"
                "CC      ####  ####\n"
                "CC  CC   ##    ## \n"
                " CCCC             \n");
        ImageService::Print(img, std::cout);
    }

    std::cout << std::endl;

    {
        Image img({30, 20}, '.');

        Drawer::DrawLine(img, {5, 8}, {15, 1}, '#');
        Drawer::DrawLine(img, {15, 1}, {25, 8}, '#');
        Drawer::DrawLine(img, {5, 8}, {25, 8}, '#');

        Drawer::DrawLine(img, {5, 8}, {5, 18}, '#');
        Drawer::DrawLine(img, {25, 8}, {25, 18}, '#');
        Drawer::DrawLine(img, {5, 18}, {25, 18}, '#');

        Drawer::DrawLine(img, {7, 10}, {9, 10}, '#');
        Drawer::DrawLine(img, {7, 10}, {7, 12}, '#');
        Drawer::DrawLine(img, {9, 10}, {9, 12}, '#');
        Drawer::DrawLine(img, {7, 12}, {9, 12}, '#');

        Drawer::DrawLine(img, {21, 10}, {23, 10}, '#');
        Drawer::DrawLine(img, {21, 10}, {21, 12}, '#');
        Drawer::DrawLine(img, {23, 10}, {23, 12}, '#');
        Drawer::DrawLine(img, {21, 12}, {23, 12}, '#');

        Drawer::DrawLine(img, {11, 18}, {13, 18}, '#');
        Drawer::DrawLine(img, {11, 18}, {11, 14}, '#');
        Drawer::DrawLine(img, {13, 18}, {13, 14}, '#');
        Drawer::DrawLine(img, {11, 14}, {13, 14}, '#');

        Drawer::DrawCircle(img, {15, 13}, 3, '#');

        ImageService::Print(img, std::cout);
    }

    {
        Image img({30, 20}, 0xFFFFFF);

        Drawer::DrawLine(img, {5, 8}, {15, 1}, 0x00FF00);
        Drawer::DrawLine(img, {15, 1}, {25, 8}, 0x00FF00);
        Drawer::DrawLine(img, {5, 8}, {25, 8}, 0x00FF00);

        Drawer::DrawLine(img, {5, 8}, {5, 18}, 0x00FF00);
        Drawer::DrawLine(img, {25, 8}, {25, 18}, 0x00FF00);
        Drawer::DrawLine(img,{5 ,18},{25 ,18 },0x00FF00);

        Drawer::FillCircle(img,{7 ,11 },1 ,0xFFFF00);
        Drawer::FillCircle(img,{21 ,11 },1 ,0xFFFF00);

        Drawer::FillCircle(img,{12 ,16 },1 ,0x0000FF);

        Drawer::FillCircle(img,{15 ,13 },3 ,0x00FFFF);
        Drawer::DrawCircle(img,{15 ,13 },3 ,0xFF0000);

        ImageService::SaveImageToPPM(img,"house_with_window.ppm");
    }

    return 0;
}