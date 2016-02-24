<?php
App::uses('AppModel', 'Model');
/**
 * EmailTemplate Model
 *
 */
class EmailTemplate extends AppModel {
  
    function selectTemplate($tempName) 
    {
        $emailTemplate = $this->find('first', array(
            'conditions' => array(
                'EmailTemplate.title' => $tempName
            ) ,
            'fields' => array(
                'EmailTemplate.description',
                'EmailTemplate.subject',
				'EmailTemplate.from',
				'EmailTemplate.reply_to_email',
				'EmailTemplate.is_html'
				
                
            ) ,
            'recursive' => -1
        ));
        $resultArray = array();
        foreach($emailTemplate as $singleArrayEmailTemplate) {
            foreach($singleArrayEmailTemplate as $key => $value) {
                $resultArray[$key] = $value;
            }
        }
        return $resultArray;
    }
}
