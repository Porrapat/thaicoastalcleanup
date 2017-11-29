<!-- Body Tabel view display -->
<?php 
    $i = 1;
    foreach($dsView as $row) {
        echo ('<tr>');
            echo('<td class="text-center">' . $i++ . '</td>');
            $lastColumn = count($row) - 1;
            $j = 0;
            foreach($row as $value) {
                if ($j == $lastColumn) {
                    echo('<td class="text-center">');
                        echo($rIccCardStatus[$value]);
                        if( ($level == 1) && ($value == 1) ) {
                            echo('<div>'
                                    . '<button id="approveIccCard"'
                                    . ' type="button" class="btn btn-info">'
                                        . 'อนุมัติ'
                                    . '</button>'
                                . '</div>'
                            );
                        }
                    echo('</td>');
                } else if ($j > 0) {
                    echo('<td class="text-left">' . $value . '</td>');
                }
                $j++;
            }
            echo('<td class="text-center">
                    <button type="submit" class="btn btn-success"
                    id="editIccCard" name="iccCardId" value='.$row['id'].'>
                        Edit
                    </button>
                </td>');
        echo ('</tr>');
    }
?>
<!-- End Body Tabel view display -->