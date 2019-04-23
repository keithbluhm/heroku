<form>
    Month:
    <select name="month">

        <?php foreach ( range( 1, 12 ) as $month ): ?>
            <option value="<?= $month ?>">
                <?= DateTime::createFromFormat( "!m", $month )->format( "F" ); ?>
            </option>

        <?php endforeach; ?>

    </select>

    &nbsp;

    Year:
    <select name="year">

        <?php foreach ( range( 1999, 2006 ) as $year ): ?>
            <option value="<?= $year ?>">
                <?= $year ?>
            </option>

        <?php endforeach; ?>

    </select>

    &nbsp;


    <input type="submit">
</form>
<?php

if ( isset( $_GET["year"], $_GET["month"] ) ) {
    $dateTime  = new DateTime( "{$_GET["year"]}-{$_GET["month"]}-01" );
    $href      = "https://philhendrie.s3.amazonaws.com/download/%s/%s/Phil+Hendrie+-+%s+%s+%s+-+Hour+%d.mp3";
    $links     = [];

    foreach ( range( 1, $dateTime->format( "t" ) ) as $date ) {
        $date = new DateTime( $dateTime->format( "Y-m-" . str_pad( $date, 2, "0", STR_PAD_LEFT ) ) );

        foreach ( range( 1, 3 ) as $hour ) {
            $link = sprintf(
                str_replace( "+", " ", $href ),
                $date->format( "Y" ),
                $date->format( "m" ),
                $date->format( "M" ),
                $date->format( "d" ),
                $date->format( "Y" ),
                $hour
            );
            $links[] = sprintf(
                "<a href=\"%s\">%s</a>",
                $link,
                $date->format( "M d Y" ) . " - Hour {$hour}"
            );
        }

    }

    echo "<pre>";

    foreach ( $links as $link ) {
        echo "&bull; {$link}\n";
    }

    echo "</pre>";

}