<?php
class AjaxController extends AbstractApiController
{
    private static $allowed_actions = array(
        'getJudges'
    );

    public function getJudges(SS_HTTPRequest $request)
    {
        $category = $request->postVar('category');

        $categories = CategoryItem::get();
        $judges     = JudgeItem::get();
        $files      = File::get();
        $category_item = $categories->filter('Title', $category);

        $output = array();

        foreach ($category_item as $category) {
            $judge_item = $judges->filter('CategoryItemID', $category->ID);
            foreach ($judge_item as $judge) {
                $file_item = $files->filter('ID', $judge->ProfileImageID);
                $judgeOutput = array(
                    'id'             => $judge->ID,
                    'judge_name'     => $judge->Title,
                    'judge_position' => $judge->Position
                );
                foreach($file_item as $file) {
                    $judgeOutput['image'][] = array(
                        'filename' => $file->Filename
                    );
                }
                $output[] = $judgeOutput;
            }
        }
        return $this->jsonOutput($output);
    }
}