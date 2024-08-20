<?php
namespace Modules\Shop\DTO\Response;

class PaginateResponse
{
    /**
     * @var string|null
     */
    private ?string $label;
    /**
     * @var bool
     */
    private bool $active = false;
    /**
     * @var int|null
     */
    private int $page;

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return void
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }


    /**
     * @param string|null $label
     * @param bool $active
     * @param int|null $page
     */
    public function __construct(?string $label, bool $active=false, ?int $page = null){
        $this->label = $label;
        $this->active = $active;
        $this->page = $page;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'label' => $this->label,
            'active' => $this->active,
            'page' => $this->page,
        ];
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string|null $label
     * @return void
     */
    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return void
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

}
