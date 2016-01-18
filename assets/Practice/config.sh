for i in {1..43}
    do
        if (( $i <= 9 ))
        then 
           index="0$i"
        else
           index="$i"
        fi
        dir_name="practice${index}"
        new_dir_name="tmp"
        cd $dir_name
        mkdir $new_dir_name
        sudo chmod 777 tmp
        cd ..
    done