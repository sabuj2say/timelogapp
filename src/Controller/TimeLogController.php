<?php

namespace App\Controller;
use App\Form\TimeLogType;
use App\Entity\TimeLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

class TimeLogController extends AbstractController
{
    #[Route('/time/log', name: 'app_time_log')]
    public function index(Request $Request, PersistenceManagerRegistry $doctrine): Response
    {
        return $this->render('time_log/index.html.twig', [
            'controller_name' => 'TimeLogController',
        ]);
    }

    
    #[Route('/create', name: 'create_time_log')]
    public function createTimeLog(Request $request, PersistenceManagerRegistry $doctrine)
    {
        $timeLog = new TimeLog();
        $form = $this->createForm(TimeLogType::class, $timeLog);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($timeLog);
            $em->flush();

            $this->addFlash('success', 'Time log created successfully.');

            return $this->redirectToRoute('create_view_log');
        }

        return $this->render('time_log/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/view', name: 'create_view_log',methods: ['GET'])]
    public function viewTimeLogs(PersistenceManagerRegistry $doctrine)
    {
        $timeLogs = $doctrine->getRepository(TimeLog::class)->findAll();
        // Calculate weekly and monthly total time
        $weeklyTotal = 0;
        $monthlyTotal = 0;
        $weeklyTotalHours= 0;
        $weeklyTotalRemainingMinutes =0;
        $monthlyTotalHours = 0;
        $monthlyTotalRemainingMinutes =0;

        
        // Get the current week's start and end dates
        $currentWeekStart = new \DateTime('this week');
        $currentWeekEnd = new \DateTime('next week');

        foreach ($timeLogs as $timeLog) {
            $startTime = $timeLog->getStartTime();
            $endTime = $timeLog->getEndTime();
            
            if ($startTime && $endTime) {
                $interval = $startTime->diff($endTime);
                $totalMinutes = $interval->days * 24 * 60 + $interval->h * 60 + $interval->i;
                
                // Convert startTime to string format for comparison
                $startTimeString = $startTime->format('Y-m-d');

                // Compare the startTime with the current week's start and end dates
                if ($startTimeString >= $currentWeekStart->format('Y-m-d') && $startTimeString < $currentWeekEnd->format('Y-m-d')) {
                    $weeklyTotal += $totalMinutes;
                }

                
                if ($startTime->format('Y-m') === date('Y-m')) {
                    $monthlyTotal += $totalMinutes;
                }

                // Convert total minutes to hours and minutes
                $weeklyTotalHours = floor($weeklyTotal / 60);
                $weeklyTotalRemainingMinutes = $weeklyTotal % 60;

                $monthlyTotalHours = floor($monthlyTotal / 60);
                $monthlyTotalRemainingMinutes = $monthlyTotal % 60;
            }
        }

        return $this->render('time_log/view.html.twig', [
            'timeLogs' => $timeLogs,
            'weeklyTotal' => $weeklyTotalHours.' hours '.$weeklyTotalRemainingMinutes,
            'monthlyTotal' => $monthlyTotalHours.'hours '.$monthlyTotalRemainingMinutes,
        ]);
    }


    #[Route('/edit/{id}', name: 'edit_time_log',methods: ['GET','POST'])]
    public function editTimeLog(Request $request, $id,PersistenceManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $timeLog = $entityManager->getRepository(TimeLog::class)->find($id);

        if (!$timeLog) {
            throw $this->createNotFoundException('TimeLog not found');
        }

        $form = $this->createForm(TimeLogType::class, $timeLog);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Time log updated successfully.');

            return $this->redirectToRoute('create_view_log');
        }

        return $this->render('time_log/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    #[Route('/delete/{id}', name: 'delete_time_log',methods: ['GET'])]
    public function deleteTimeLog($id,PersistenceManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $timeLog = $entityManager->getRepository(TimeLog::class)->find($id);

        if (!$timeLog) {
            throw $this->createNotFoundException('TimeLog not found');
        }

        $entityManager->remove($timeLog);
        $entityManager->flush();

        $this->addFlash('success', 'Time log deleted successfully.');

        return $this->redirectToRoute('create_view_log');
    }

    
    

    #[Route('/calculate-totals', name: 'calculate_totals',methods: ['GET'])]
    public function calculateTotals(PersistenceManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        
        // Fetch all TimeLog entities from the database
        $timeLogs = $entityManager->getRepository(TimeLog::class)->findAll();
        
        

        return $this->render('time_log/view.html.twig', [
            'weeklyTotal' => $weeklyTotal,
            'monthlyTotal' => $monthlyTotal,
        ]);
    }




}







