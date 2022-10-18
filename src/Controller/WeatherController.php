<?php // src/Controller/WeatherController.php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Localization;
use App\Repository\MeasurementRepository;
use App\Repository\LocalizationRepository;
class WeatherController extends AbstractController
{
 public function cityAction(Localization $city, MeasurementRepository $measurementRepository): Response
 {
    $measurements = $measurementRepository->findByLocalization($city);
    return $this->render('weather/city.html.twig', [
    'localization' => $city,
    'measurements' => $measurements,
    ]);
 }

 public function cityActionByCity(String $cityName, MeasurementRepository $measurementRepository, LocalizationRepository $localizationRepository): Response
 {
    $city = $localizationRepository->findCityByCityName($cityName);
    $measurements = $measurementRepository->findByLocalization($city);
    return $this->render('weather/city.html.twig', [
    'localization' => $city,
    'measurements' => $measurements,
    ]);
 }
 
}