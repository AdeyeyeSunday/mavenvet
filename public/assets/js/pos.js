function yesnoCheck(that)
{
    if (that.value == "Cash")
    {
        document.getElementById("adc").style.display = "block";
    }
    else
    {
        document.getElementById("adc").style.display = "none";
    }

    if (that.value == "Transfer")
    {
        document.getElementById("pc").style.display = "block";
    }
    else
    {
        document.getElementById("pc").style.display = "none";
    }
    if (that.value == "Pos")
    {
        document.getElementById("ps").style.display = "block";
    }
    else
    {
        document.getElementById("ps").style.display = "none";
    }


    if (that.value == "cash_pos")
    {
        document.getElementById("pd").style.display = "block";
    }
    else
    {
        document.getElementById("pd").style.display = "none";
    }



    if (that.value == "cash_transfer")
    {
        document.getElementById("pf").style.display = "block";
    }
    else
    {
        document.getElementById("pf").style.display = "none";
    }
}
