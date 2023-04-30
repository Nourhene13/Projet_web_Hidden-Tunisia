<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuizController extends AbstractController
{
    /**
     * @Route("/quiz", name="quiz")
     */
    public function index(): Response
    {
        $questions = [
            [
                'question' => 'Quelle est la capitale de la France ?',
                'options' => ['Paris', 'Madrid', 'Londres'],
            ],
            [
                'question' => 'Quelle est la couleur du ciel ?',
                'options' => ['Bleu', 'Rouge', 'Vert'],
            ],
        ];

        return $this->render('quiz/index.html.twig', [
            'questions' => $questions,
        ]);
    }

    /**
     * @Route("/quiz/submit", name="quiz_submit", methods={"POST"})
     */
    public function submit(Request $request): Response
    {
        $questions = [
            [
                'question' => 'Quelle est la capitale de la France ?',
                'answer' => 'Paris',
            ],
            [
                'question' => 'Quelle est la couleur du ciel ?',
                'answer' => 'Bleu',
            ],
        ];

        $correctAnswers = 0;

        foreach ($questions as $question) {
            $userAnswer = $request->request->get($question['question']);

            if ($userAnswer === $question['answer']) {
                $correctAnswers++;
            }
        }

        return $this->render('quiz/result.html.twig', [
            'correctAnswers' => $correctAnswers,
            'totalQuestions' => count($questions),
        ]);
    }
}
