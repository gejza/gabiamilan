<?php

namespace App\Controller;

use App\Entity\Image;
use App\Repository\ImageRepository;
use App\Service\ImageTool;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class GalleryController extends BaseController
{
	/** @var ImageRepository Repositář pro správu článků. */
	private $imageRepository;
	
	/**
	 * Konstruktor kontroleru pro práci s články.
	 * @param ImageRepository $imageRepository automaticky injektovaný repositář pro správu článků
	 */
	public function __construct(ImageRepository $imageRepository)
	{
		$this->imageRepository = $imageRepository;
	}
	
    /**
     * @Route("/svatba/gallery", name="gallery")
     */
    public function index(ImageTool $imageTool): Response
    {
    	$d = $this->gendata();
    	unset($d['menu']);
    	$d['images'] = $this->imageRepository->findAll();
    	dump($d);
        return $this->render('gallery/index.html.twig', $d);
    }
	
	/**
	 * Vytváří a zpracovává formulář pro editaci článku podle jeho URL.
	 * @param string|null $url     URL článku
	 * @param Request     $request HTTP požadavek
	 * @return Response HTTP odpověď
	 * @Route("/svatba/gallery/editor/{url}", name="image_editor")
	 * @throws ORMException Jestliže nastane chyba při ukládání článku.
	 */
	public function editor(string $url = null, Request $request): Response
	{
		if ($url) { // Pokud byla zadána URL, pokusí se načíst článek podle ní.
			if (!($image = $this->imageRepository->findOneByUrl($url))) {
				// Pokud se článek s danou URL nepodaří najít, vypíše chybovou hlášku a vytvoří nový s danou URL.
				$this->addFlash('warning', 'Článek se zadanou URL nebyl nalezen!');
				$image = (new Image())->setUrl($url);
			}
		} else $image = new Image(); // Jinak se nejedná o editaci článku a vytváří se nový článek.
		
		// Vytváření editačního formuláře podle entity článku.
		$editorForm = $this->createFormBuilder($image)
			->add('title', null, ['label' => 'Titulek', 'required' => false])
			->add('file', null, ['label' => 'URL'])
			//->add('description', null, ['label' => 'Popisek'])
			//->add('content', null, ['label' => 'Obsah', 'required' => false])
			->add('submit', SubmitType::class, ['label' => 'Uložit článek'])
			->getForm();
		
		// Zpracování editačního formuláře.
		$editorForm->handleRequest($request);
		if ($editorForm->isSubmitted() && $editorForm->isValid()) {
			$this->imageRepository->save($image);
			$this->addFlash('notice', 'Článek byl úspěšně uložen.');
			return $this->redirectToRoute('gallery');
			//return $this->redirectToRoute('image', ['url' => $image->getUrl()]);
		}
		
		// Předání editačního formuláře do šablony.
		$d = $this->gendata();
		$d['editorForm'] = $editorForm->createView();
		dump($d);
		return $this->render('gallery/editor.html.twig', $d);
	}
	
	/**
	 * @param Request     $request HTTP požadavek
	 * @return Response HTTP odpověď
	 * @Route("/svatba/gallery/upload", methods={"POST"}, name="image_upload")
	 * @throws ORMException Jestliže nastane chyba při ukládání článku.
	 */
	public function upload(ImageTool $imageTool, Request $request)
	{
		/*
		$destination = $this->getParameter('kernel.project_dir').'/public/uploads';
		$dest_thumb = $destination . '/thb';
		$imageTool->scan_dir($destination, $dest_thumb);
		return new Response('');
		*/
		
		//dump($request);
		$uploadedFile = $request->files->get('image');
		$fname = $uploadedFile->getClientOriginalName();
		$destination = $this->getParameter('kernel.project_dir').'/public/uploads';
		$ret = $uploadedFile->move($destination, $fname);
		$dest_thumb = $destination . '/thb/';
		$imageTool->createThumbnail($ret->getRealPath(), $dest_thumb . $fname, 200);
		
		$image = new Image();
		$image->setFile($fname);
		$imageTool->update_info($ret->getRealPath(), $image);
		$this->imageRepository->save($image);
		return new Response(var_dump($ret));
		
		$ret = $uploadedFile->move($destination);
		return new Response($imageTool->img($ret->getRealPath()));
	}
}
