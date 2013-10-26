<?php

class Inclusive_Pdf_Table 
{
	
	protected $_borders = false;
	
	protected $_columns = array();
	
	protected $_encoding = 'UTF-8';
	
	protected $_headFont = null;
	
	protected $_headFontSize = null;
	
	protected $_padding = 2;
	
	protected $_rows = array();
	
	protected $_rowHeight = 18;
	
	protected $_rowFont = null;
	
	protected $_rowFontSize = null;
	
	public function addColumn($key,$width,$label)
	{
	
		$this->_columns[$key] = array(
			'width'=>$width,
			'label'=>$label
			);
		
		return $this;
	
	}
	
	public function addRow(array $row)
	{
	
		$this->_rows[] = $row;
		
		return $this;
	
	}
	
	public function enableBorders()
	{
	
		$this->_borders = true;
		
		return $this;
	
	}
	
	public function renderToPage(Zend_Pdf_Page $page,$x,$y)
	{
	
		$currentX = $x;
		
		$currentY = $y;
	
		// Render Columns
		
		$page->setFont($this->_headFont,$this->_headFontSize);
		
		$totalWidth = 0;
		$totalHeight = count($this->_rows) * $this->_rowHeight + $this->_headFontSize;
		
		foreach ($this->_columns as $key => $column)
		{
		
			$page->drawText($column['label'],$currentX+$this->_padding,$currentY-$this->_headFontSize,$this->_encoding);
						
			$currentX += $column['width'];
			
			$totalWidth += $column['width'];
		
		}
		
		if ($this->_borders)
		{
			// Top Line
			$page->drawLine($x,$y,$x+$totalWidth,$y);
		
		}
		
		// Render Rows
		
		$currentX = $x;
		
		$currentY -= 5 + $this->_headFontSize;
		
		$lineY = $currentY;
		
		$page->setFont($this->_rowFont,$this->_rowFontSize);
		
		$first = true;
		
		foreach ($this->_rows as $row)
		{
			
			if ($this->_borders or $first)
			{
				// Row Line
				$page->drawLine($x,$currentY-2,$x+$totalWidth,$currentY-2);
				
				$first = false;
			
			}
			
			$currentY -= $this->_rowHeight;
			
			foreach ($this->_columns as $key => $column)
			{
				
				if (isset($row[$key]))
				{
					
					$page->drawText($row[$key],$currentX+$this->_padding,$currentY+$this->_padding,$this->_encoding);
					
				}
				
				$currentX += $column['width'];
			
			}
						
			$currentX = $x;
			
		}
		
		if ($this->_borders)
		{
			// Bottom Line
			$page->drawLine($x,$currentY-2,$x+$totalWidth,$currentY-2);
		
		}
		
		if ($this->_borders)
		{
			// Left Line
			$page->drawLine($x,$y,$x,$currentY-2);
			
			$currentX = $x;
			
			foreach ($this->_columns as $key => $column)
			{
				
				$currentX += $column['width'];
				
				$page->drawLine($currentX,$y,$currentX,$currentY-2);
				
			}
		
		}
		
		return $page;
	
	}
	
	public function rowCount()
	{
	
		return count($this->_rows);
	
	}
	
	public function setHeadFont($font,$size=null)
	{
	
		$this->_headFont = $font;
		
		$this->_headFontSize = $size;
		
		return $this;
	
	}
	
	public function setRowFont($font,$size=null)
	{
	
		$this->_rowFont = $font;
		
		$this->_rowFontSize = $size;
		
		return $this;
	
	}
	
	public function setRowHeight($height)
	{
	
		$this->_rowHeight = $height;
		
		return $this;
	
	}
	
}